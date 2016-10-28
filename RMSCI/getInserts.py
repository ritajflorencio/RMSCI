import dicom
import os
import re


y = 0 ## id patient doesnt have id
i = 0 ## if exam doesnt have id

def sqlquote(value):
    """Naive SQL quoting

    All values except NULL are returned as SQL strings in single quotes,
    with any embedded quotes doubled.

    """
    if value == None:
        return 'NULL'
    elif value == "SELECT MAX(imageID) FROM image":
        other = value
        return '(SELECT MAX(imageID) FROM image)'
    return "'{}'".format(str(value).replace("'", ""))



def Data(data, par):
    """Returns a list of values
    Requires: data is a list of DICOM parameters of a specific file, and par
    is a list of parameters of interest
    Ensures: list of values corresponding to the parameters given"""

    inform = {}
    for entry in par:
        if entry=="email":
            inform[entry]=email

        elif entry=="imageID":
            inform[entry]="SELECT MAX(imageID) FROM image"
        else:
            for method in dir(data):
                info = False
                
                if entry == method:
                    imageData = getattr(data, method)
                    
                    if entry=="ExposureTime":
                        inform[entry]=float(imageData)*0.001
                        info = True
                        break
                    elif entry == "PatientAge":
                        inform[entry]=int(imageData[0:3])
                        info = True
                        break
                    elif entry=="SliceThickness" or entry=="FocalSpots" or entry=="BodyPartThickness":
                        inform[entry]=float(imageData)/10
                        info = True
                        break
                    elif entry=="ImageAndFluoroscopyAreaDoseProduct" or entry=="OrganDose":
                        inform[entry]=float(imageData)*100
                        info = True
                        break
                    elif entry=="EntranceDose":
                        if str(imageData) == '[]':
                            inform[entry]=None
                            info = True
                            break
                        else:
                            inform[entry]=float(imageData)*100
                            info = True
                            break
                    else:
                        inform[entry] = str(imageData)
                        info = True
                        
                        break
                
            if info == False:
                inform[entry] = None
    

    return inform


def IntroducesPatientData(data):


    pat_info = Data(data, ["PatientID", "PatientSex", "PatientAge", "PregnancyStatus", "email"])
    if pat_info["PatientID"] == "":
        pat_info["PatientID"] = str(y + 1)
        y = y + 1

      



    sqlfile.write("INSERT IGNORE INTO patient VALUES ({PatientID}, {PatientSex}, {PatientAge}, {PregnancyStatus}, {email})\n".format(**{k: sqlquote(v) for k,v in pat_info.items()}))
    
    return


def IntroducesExamData(data):


    exam_info = Data(data, ["StudyInstanceUID", "ContentDate", "Manufacturer", "ManufacturerModelName", "Modality", "DLP_mGYcm", "DAP_mGycm2", "OperatorsName", "PatientID", "email"])
    if exam_info["PatientID"] == "":
        exam_info["PatientID"] = y
  
    
    if exam_info["Modality"] == 'CT' and exam_info["ManufacturerModelName"] == "Mammomat Inspiration":
        exam_info["Modality"] = 'MG'

    if exam_info["StudyInstanceUID"] == "":
        exam_info["StudyInstanceUID"] = str(i + 1)
        i= i + 1


        
    sqlfile.write("INSERT IGNORE INTO exam VALUES ({StudyInstanceUID}, {ContentDate}, {Manufacturer}, {ManufacturerModelName}, {Modality}, {OperatorsName}, {DLP_mGYcm}, {DAP_mGycm2}, {PatientID}, {email})\n".format(**{k: sqlquote(v) for k,v in exam_info.items()}))
    return 


def IntroducesImageData(data):
    

    
    image_info = Data(data, ["StudyInstanceUID", "StudyDescription", "BodyPartExamined", "KVP", "ExposureTime", "email"])
    if image_info["StudyInstanceUID"] == "":
        image_info["StudyInstanceUID"] = i

    
    sqlfile.write("INSERT INTO image (StudyDescription,bodyPart, voltage_kV, exposureTime_Secs, examID, email) VALUES ({StudyDescription}, {BodyPartExamined}, {KVP}, {ExposureTime}, {StudyInstanceUID}, {email})\n".format(**{k: sqlquote(v) for k,v in image_info.items()}))


    return 


def IntroducesTCData(data):

    
    tc_info = Data(data, ["imageID", "StudyInstanceUID", "CTDIvol", "SpiralPitchFactor", "SliceThickness", "email"])
    if tc_info["StudyInstanceUID"] == "":
        tc_info["StudyInstanceUID"] = i

    if tc_info["SpiralPitchFactor"]!=None:
        tc_info["CTDIw"] = float(tc_info["CTDIvol"])*float(tc_info["SpiralPitchFactor"])
    else:
        tc_info["CTDIw"] = None

    sqlfile.write("INSERT INTO ct VALUES ({imageID}, {StudyInstanceUID}, {CTDIvol}, {CTDIw}, {SpiralPitchFactor}, {SliceThickness}, {email})\n".format(**{k: sqlquote(v) for k,v in tc_info.items()}))

    
    return

def IntroducesCRData(data):


    xray_info = Data(data, ["imageID", "StudyInstanceUID", "SeriesDescription", "ViewPosition", "RelativeXRayExposure", "ExposureIndex", "ImageAndFluoroscopyAreaDoseProduct", "FocalSpots", "email"])
    
    if xray_info["StudyInstanceUID"] == "":
        xray_info["StudyInstanceUID"] = i
    


    if xray_info["SeriesDescription"]!=None:


        sqlfile.write("INSERT IGNORE INTO cr VALUES ({imageID}, {StudyInstanceUID}, {SeriesDescription}, {RelativeXRayExposure}, {ExposureIndex}, {ImageAndFluoroscopyAreaDoseProduct}, {FocalSpots}, {email})\n".format(**{k: sqlquote(v) for k,v in xray_info.items()}))
    else:
        if xray_info["ViewPosition"]!=None:


            sqlfile.write("INSERT INTO cr VALUES ({imageID}, {StudyInstanceUID}, {ViewPosition}, {RelativeXRayExposure}, {ExposureIndex}, {ImageAndFluoroscopyAreaDoseProduct}, {FocalSpots}, {email})\n".format(**{k: sqlquote(v) for k,v in xray_info.items()}))

        else:

            sqlfile.write("INSERT INTO cr VALUES ({imageID}, {StudyInstanceUID}, {SeriesDescription}, {RelativeXRayExposure}, {ExposureIndex}, {ImageAndFluoroscopyAreaDoseProduct}, {FocalSpots}, {email})\n".format(**{k: sqlquote(v) for k,v in xray_info.items()}))


    return 


def IntroducesMGData(data):
    


    mg_info = Data(data, ["imageID", "StudyInstanceUID", "OrganDose", "RelativeXRayExposure", "EntranceDose", "EntranceDoseInmGy", "BodyPartThickness", "CompressionForce", "email"])

    if mg_info["StudyInstanceUID"] == "":
        mg_info["StudyInstanceUID"] = i


    if mg_info["EntranceDoseInmGy"] == None and mg_info["EntranceDose"] != None:


        sqlfile.write("INSERT INTO mg VALUES ({imageID}, {StudyInstanceUID}, {OrganDose}, {RelativeXRayExposure}, {EntranceDose}, {BodyPartThickness}, {CompressionForce}, {email})\n".format(**{k: sqlquote(v) for k,v in mg_info.items()}))
    elif mg_info["EntranceDoseInmGy"] != None and mg_info["EntranceDose"] == None:


        sqlfile.write("INSERT INTO mg VALUES ({imageID}, {StudyInstanceUID}, {OrganDose}, {RelativeXRayExposure}, {EntranceDoseInmGy}, {BodyPartThickness}, {CompressionForce}, {email})\n".format(**{k: sqlquote(v) for k,v in mg_info.items()}))


    elif (mg_info["EntranceDoseInmGy"] == None and mg_info["EntranceDoseInmGy"] == None) or (mg_info["EntranceDoseInmGy"] != None and mg_info["EntranceDoseInmGy"] != None):



        sqlfile.write("INSERT INTO mg VALUES ({imageID}, {StudyInstanceUID}, {OrganDose}, {RelativeXRayExposure}, {EntranceDoseInmGy}, {BodyPartThickness}, {CompressionForce}, {email})\n".format(**{k: sqlquote(v) for k,v in mg_info.items()}))


   

    return mg_info


def DICOMProcessing (path):
    """Returns a list of dicom files in a given path
    Requires: path is the path for the archives/files
    Ensures: a list of dicom files in the given path"""
    i = 1 
    sqlfile.write("INSERT IGNORE INTO users VALUES ('" + user + "', NULL, '" + email + "')\n")
    for dirName, subdirList, fileList in os.walk(path):
        
        for filename in fileList:

            # check whether the file's DICOM

            if ".dcm" in filename.lower() and getattr(dicom.read_file(os.path.join(dirName,filename)), "Modality") in ["CT", "MG", "CR"]: # check whether the file's DICOM and corresponds to the modalities given
                
                data = dicom.read_file(os.path.join(dirName,filename))
                IntroducesPatientData(data) ## STARTS INTRODUCING PATIENT INFO
                IntroducesExamData(data) ## STARTS INTRODUCING EXAM INFO
                IntroducesImageData(data) ## STARTS INTRODUCING IMAGE INFO

                if getattr(data, "Modality") == 'CT' and getattr(data, "ManufacturerModelName") != 'Mammomat Inspiration' and getattr(data, "InstanceNumber")!= 0: ## STARTS INTRODUCING TC INFO     
                    IntroducesTCData(data)
                    print "CT Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'CT' and getattr(data, "ManufacturerModelName") == 'Mammomat Inspiration': ## STARTS INTRODUCING MG INFO
                    IntroducesMGData(data)
                    print " MG Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'CR': ## STARTS INTRODUCING XRAY INFO
                    IntroducesCRData(data)
                    print "CR Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'MG': ## STARTS INTRODUCING MG INFO
                    IntroducesMGData(data)
                    print "MG Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

    

    return "Done!"



email = str(raw_input('Type your email and press Enter:'))
while  re.match('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$', email) == None:
    email = str(raw_input('Type a valid email and press Enter:'))
user = str(raw_input('Type the username (up to 10 digits) and press Enter:'))
while len(user)>10 and user=='all':
    user = str(raw_input('Type a valid username (up to 10 digits) and press Enter:'))
path = str(raw_input('Type the path and press Enter(format: ./foldername    NOTE: the script and the folder should be in the same place):'))

while os.path.exists(path)== False:
    path = str(raw_input('Type a valid path and press Enter(format: ./foldername    NOTE: the script and the folder should be in the same place):'))

file_name = user + '.sql'
sqlfile = open(file_name, 'a')
print DICOMProcessing(path)
sqlfile.close()

import MySQLdb

## connects to db
db = MySQLdb.connect("", "", "", "")
cur = db.cursor()
db.autocommit(True)

y = 0 ## id patient doesnt have id
i = 0 ## if exam doesnt have id

def Data(data, par):
    """Returns a dictionary of key-values
    Requires: data is a list of DICOM parameters of a specific file, and par
    is a list of parameters of interest
    Ensures: dictionary where the key corresponds to the parameters given and the value its value"""

    inform = {}
    for entry in par:
       
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
                
        if info==False:
            inform[entry] = None
        
    return inform


def IntroducesPatientData(data):
   
    global y
    pat_info = Data(data, ["PatientID", "PatientSex", "PatientAge", "PregnancyStatus"])

    if pat_info["PatientID"] == "":
        pat_info["PatientID"] = str(y + 1)
        y = y + 1


    pat_query =("INSERT IGNORE INTO patient VALUES (%s, %s, %s, %s, %s);", (pat_info["PatientID"], pat_info["PatientSex"], pat_info["PatientAge"], pat_info["PregnancyStatus"], 'public5246was@fakemail.com'))
    cur.execute(*pat_query)
    cur.execute("INSERT IGNORE INTO users VALUES ('public', 'public', 'public5246was@fakemail.com');")

    return pat_info


def IntroducesExamData(data):
   
    global y
    global i
    exam_info = Data(data, ["PatientID", "StudyInstanceUID", "ContentDate", "Manufacturer", "ManufacturerModelName", "Modality", "OperatorsName"])

    if exam_info["Modality"] == 'CT' and exam_info["ManufacturerModelName"] == "Mammomat Inspiration":
        exam_info["Modality"] = 'MG'

    if exam_info["StudyInstanceUID"] == "":
        exam_info["StudyInstanceUID"] = str(i + 1)
        i= i + 1

    if exam_info["PatientID"] == "":
        exam_info["PatientID"] = y

        
    exam_query =("INSERT IGNORE INTO exam VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s);", (exam_info["StudyInstanceUID"], exam_info["ContentDate"], exam_info["Manufacturer"], exam_info["ManufacturerModelName"], exam_info["Modality"], exam_info["OperatorsName"], None, None, exam_info["PatientID"], 'public5246was@fakemail.com'))
    cur.execute(*exam_query)


    return exam_info


def IntroducesImageData(data):

    global i
    image_info = Data(data, ["StudyInstanceUID", "StudyDescription", "BodyPartExamined", "KVP", "ExposureTime"])
    if image_info["StudyInstanceUID"] == "":
        image_info["StudyInstanceUID"] = i

    image_query =("INSERT INTO image (StudyDescription, bodyPart, voltage_kV, exposureTime_Secs, examID, email)  VALUES (%s, %s, %s, %s, %s, %s);", (image_info["StudyDescription"], image_info["BodyPartExamined"], image_info["KVP"], image_info["ExposureTime"], image_info["StudyInstanceUID"], 'public5246was@fakemail.com'))
    cur.execute(*image_query)

    return image_info


def IntroducesCTData(data):
  
    global i
    tc_info = Data(data, ["StudyInstanceUID", "CTDIvol", "SpiralPitchFactor", "SliceThickness"])
    if tc_info["SpiralPitchFactor"]!=None:
        CTDIw = float(tc_info["CTDIvol"])*float(tc_info["SpiralPitchFactor"])
    else:
        CTDIw = None

    cur_id = cur.execute("select LAST_INSERT_ID() FROM image;")
    if tc_info["StudyInstanceUID"] == "":
        tc_info["StudyInstanceUID"] = i

    tc_query = ("INSERT INTO CT VALUES(%s, %s, %s, %s, %s,%s, %s);",(cur_id, tc_info["StudyInstanceUID"], tc_info["CTDIvol"], CTDIw, tc_info["SpiralPitchFactor"], tc_info["SliceThickness"], 'public5246was@fakemail.com'))
    cur.execute(*tc_query)
    
    return tc_info

def IntroducesCRData(data):
    global i
    xray_info = Data(data, ["StudyInstanceUID", "SeriesDescription", "RelativeXRayExposure", "ExposureIndex", "ImageAndFluoroscopyAreaDoseProduct", "FocalSpots", "ViewPosition"])
    cur_id = cur.execute("select LAST_INSERT_ID() FROM image;")
    if xray_info["StudyInstanceUID"] == "":
        xray_info["StudyInstanceUID"] = i


    if xray_info["SeriesDescription"]!=None:


        xray_query =("INSERT INTO CR VALUES (%s, %s, %s, %s, %s, %s, %s, %s);", (cur_id, xray_info["StudyInstanceUID"], xray_info["SeriesDescription"], xray_info["RelativeXRayExposure"], xray_info["ExposureIndex"], xray_info["ImageAndFluoroscopyAreaDoseProduct"], xray_info["FocalSpots"], 'public5246was@fakemail.com'))
        cur.execute(*xray_query)
    else:
        if xray_info["ViewPosition"]!=None:

            xray_query =("INSERT INTO CR VALUES (%s, %s, %s, %s, %s, %s, %s, %s);", (cur_id, xray_info["StudyInstanceUID"], xray_info["ViewPosition"], xray_info["RelativeXRayExposure"], xray_info["ExposureIndex"], xray_info["ImageAndFluoroscopyAreaDoseProduct"], xray_info["FocalSpots"],'public5246was@fakemail.com'))
            cur.execute(*xray_query)
        else:

            xray_query =("INSERT INTO CR VALUES (%s, %s, %s, %s, %s, %s, %s, %s);", (cur_id, xray_info["StudyInstanceUID"], xray_info["SeriesDescription"], xray_info["RelativeXRayExposure"], xray_info["ExposureIndex"], xray_info["ImageAndFluoroscopyAreaDoseProduct"], xray_info["FocalSpots"], 'public5246was@fakemail.com'))
            cur.execute(*xray_query)

    return xray_info


def IntroducesMGData(data):
    global i
    mg_info = Data(data, ["StudyInstanceUID", "OrganDose", "RelativeXRayExposure", "EntranceDoseInmGy", "EntranceDose", "BodyPartThickness", "CompressionForce"])
    cur_id = cur.execute("select LAST_INSERT_ID() FROM image;")

    if mg_info["StudyInstanceUID"] == "":
        mg_info["StudyInstanceUID"] = i
    
    if mg_info["EntranceDose"] == '[]':
        mg_info["EntranceDose"] = None

   

    elif mg_info["EntranceDoseInmGy"] != None:

        
        mg_query = ("INSERT INTO MG VALUES(%s, %s, %s, %s, %s, %s, %s, %s);",(cur_id, mg_info["StudyInstanceUID"], mg_info["OrganDose"], mg_info["RelativeXRayExposure"], mg_info["EntranceDoseInmGy"], mg_info["BodyPartThickness"], mg_info["CompressionForce"], 'public5246was@fakemail.com'))

        cur.execute(*mg_query)

    else: 

        mg_query1 = ("INSERT INTO MG VALUES(%s, %s, %s, %s, %s, %s, %s, %s);",(cur_id, mg_info["StudyInstanceUID"], mg_info["OrganDose"], mg_info["RelativeXRayExposure"], mg_info["EntranceDose"], mg_info["BodyPartThickness"], mg_info["CompressionForce"], 'public5246was@fakemail.com'))

        cur.execute(*mg_query1)

    

    return mg_info

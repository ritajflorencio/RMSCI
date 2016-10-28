import dicom
import os
import dbInserts
import sys

def DICOMProcessing (path):
    """Returns a list of dicom files in a given path
    Requires: path is the path for the archives/files
    Ensures: a list of dicom files in the given path"""
    i = 1 
    
    for dirName, subdirList, fileList in os.walk(path):
        
        for filename in fileList:

            # check whether the file's DICOM
            
            if ".dcm" in filename.lower() and getattr(dicom.read_file(os.path.join(dirName,filename)), "Modality") in [sys.argv[2], sys.argv[3], sys.argv[4]]: # check whether the file's DICOM and corresponds to the modalities given
                
                data = dicom.read_file(os.path.join(dirName,filename))
                dbInserts.IntroducesPatientData(data) ## STARTS INTRODUCING PATIENT INFO
                dbInserts.IntroducesExamData(data) ## STARTS INTRODUCING EXAM INFO
                dbInserts.IntroducesImageData(data) ## STARTS INTRODUCING IMAGE INFO

                if getattr(data, "Modality") == 'CT' and getattr(data, "ManufacturerModelName") != 'Mammomat Inspiration' and getattr(data, "InstanceNumber")!= 0: ## STARTS INTRODUCING TC INFO     
                    dbInserts.IntroducesCTData(data)
                    print "CT Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'CT' and getattr(data, "ManufacturerModelName") == 'Mammomat Inspiration': ## STARTS INTRODUCING MG INFO
                    dbInserts.IntroducesMGData(data)
                    print " MG Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'CR': ## STARTS INTRODUCING XRAY INFO
                    dbInserts.IntroducesCRData(data)
                    print "CR Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

                elif getattr(data, "Modality") == 'MG': ## STARTS INTRODUCING MG INFO
                    dbInserts.IntroducesMGData(data)
                    print " MG Image " + str(i) +" introduced - " + str(os.path.join(dirName,filename))
                    i = i + 1

    

    return "Done!"


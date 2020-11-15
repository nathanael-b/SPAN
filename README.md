# SPAN
 
## What is SPAN?
SPAN is the *Standardized Positional and Application Notation*, developed to standardize the way job applicants provide information to the Applicant Tracking System. 

## SPAN Version 1.0
SPAN Version 1.0 is the foundational basis for utlizing SPAN to import resumes. 

## Data Standards
SPAN Objects are governed by the data standards outlined in the standards and frameworks below. 

- [XML Data Dictionary](XMLDataDictionary.md)
- JSON Data Dictionary _Planned for Version 1.1_
- [SPAN Import Export Framework](SPANImportExportFramework.md)
- [SPAN ShortCode Standard](SPANCodeStandard.md)

## SPAN Modules
Version 1 of SPAN includes Module 1. Module 2 is planned for version 2.0 and Module 3 has not been assigned a release version. 

### Module 1 - Resume/CV Standard
The Resume standrd is the foundational element of the SPAN standard allowing for resumes to be submitted by applicants in a standardized format. 

The [Parser Sample](parse.php) can be used to easily convert a `.resume` XML-based file into a printer-friendly and reader-friendly version. 

A [Sample Resume](resumeSample.resume) is included showing the features of the SPAN standard resume. A [PDF Version](sampleOutput.pdf) is included for reference. 

### Module 2 - Position Description and Advertisement Standard
The PD Standard will allow Human Resources departments to export Position Descriptions from HRIS applications for use in partner applications and job boards. 

### Module 3 - Application Submission Standard
The application submission framework will allow for a merging of a resume and additional information, such as supplemental questions, government form responses, and e-signatures, into a single SPAN Object, simplifying how HRIS applications can interface with third-party Job-Boards.

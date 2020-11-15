# Import Export Framework 
This document describes the standard for how exporters, importers, and parsers should manage the data frameworks within SPAN. This standard applies to SPAN-XML and SPAN-JSON.

## File Types

### Resumes
Resumes can be submitted in XML or JSON format based on the available standards. When a Resume is saved to a media device or service the format is:
- `*.resume` - XML Resume in SPAN Format
- `*.jresume` - JSON Resume in SPAN Format

### Multi-Object Packages
- `*.spanpackage` - Multiple SPAN-XML Objects in a single file.
- `*.jspanpackage` - Multiple SPAN-JSON Objects in a single file.

## Dates
This section describes how varying international date formats are handled by exporters, importers, and parsers. All dates only contain numerical charachters and dashes (-). 

### Year Only Dates
When a date is utilized as a Year only it will be displayed in four digits.

> `<start>2020</start>`

### Month and Year Dates 
When a date includes only a month and a year the date will be completed as a full two digit month, a dash, and the four digit year. 

>`<start>02-2020</start>`

### Full Dates
Full date formats vary by country, with the most common date being dd-mm-yyyy. This format is the standard for SPAN documents except in the following circumstances.

- When the month segment exceeds 12 - The parser will revert to a `mm-dd-yyyy` format for the single date. 
- When the `region="USA"` attribute is included in the `<spanOb>` tag - The parser will utilize `mm-dd-yyyy` for all dates.
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
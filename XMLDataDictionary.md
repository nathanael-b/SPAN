# SPAN XML Data Dictionary 

## Object Basics

**Span Object** 

`<spanOb></spanOb>`

The SpanObject tag is used to designate the beginning and end of a SPAN1 Object. SpanObject tags allow parsers to accept multiple objects in one request. 

The SpanObject tag must include a `type` attribute:
- `resume` -Used for Applicant Resumes
- `position` -Used for Position Descriptions *not included in this standard yet*

The correct syntax for the SpanOb tag is:

`<spanOb type="resume"> ... </spanOb>`
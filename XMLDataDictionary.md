# SPAN XML Data Dictionary 

## Object Basics

**Span Object** 

> `<spanOb></spanOb>`

The SpanObject tag is used to designate the beginning and end of a SPAN1 Object. SpanObject tags allow parsers to accept multiple objects in one request. 

The SpanObject tag must include a `type` attribute:
- `resume` -Used for Applicant Resumes
- `position` -Used for Position Descriptions *not included in this standard yet*

The SpanObject tag should include a version attribute, referencing the SPAN version that is utilized. If a version attribute is not declared, the parser may utilize its own default version. This behavior may cause depricated or advanced tags and attributes to be ignored, or may create syntax errors. 

The correct syntax for the SpanOb tag is:

> `<spanOb version="1.0" type="resume"> ... </spanOb>`

## Standard Tags

A standard tag is a tag that may be utilzed within multiple element types in the same manner. Generally, standard tags must be a child of a parent element. For example, a name tag must be the child of an institution or person element. 

**Legal Name**

> `<legalName></legalName>`

The Legal Name tag is used to indicate an entity’s legal name when that entity is not of the “People” type. The Legal Name tag can be set within the Candidate tag but is mandatory within the Issuer, Institution, and Employer tags.

The Legal Name tag is ignored when a Given Name / Family name are present within the same tag space.

**Contact**

> `<contact type="..." primary=true/false></contact>`

The Contact tag indicates a communication method. 

The “type” attribute of the tag must be appropriately set to:
- landphone - Landline Telephone Num
- mobilepohne - Cell Phone
- email - Email Address
- im - Instant Messaging Client

Phone numbers must include the “country” attribute, set to the appropriate international calling code (I.e. country=”+1” for the United States)

Cell Phones must include the “allowsms” attribute set to either “true”/”false”

Contacts must include the “preferred” attribute set to either “true”/”false”. This is a boolean modifier and may be set for multiple contact types. 

**Address**

> `<address style="..." type="..." mail=true/false>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<number hasUnit=true/false>...</number>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<streetName>...</streetName>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<streetType>...</streetType>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<unit>...</unit>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<city>...</city>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<state>...</state> / <prov>...</prov> / <reg>...</reg>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`<country>...</country>`
>
> `</address>`

The Address tag is a container for physical address information. 

The “style” attribute is optional, but may assist in parsing address information. The style of an address indicates the setup of mail addresses in a local market.  (I.e. `style=”NA”` for North American addresses or `style=”UK”` for United Kingdom Addresses)

The “type” tag is required for all addresses. 
- home - Residential Home Addresses
- office - Business address of a People type.
- business - A business’s address .
- other - PO Boxes and Other Addresses

The “mail” tag should be set to “true” to indicate that this is the address that the parent receives physical mail. When left unset this attribute is read as “false”.

**_Street Number_**

The Street Number tag is used to indicate the street number (house number) of an address. If this address has a unite (such as an apartment number, suite, floor, etc) the “hasUnit” attribute must be set to “true”.

**_Street Name_**

The Street Name is the unique portion of a Street Name. 

Example: Main St 

> `<streetName>Main</streetName>`

**_Street Type_**

This is the full type of a Street..

Example: Main St 

> `<streetType>Street</streetType>`

**_Unit_**

The Unit Number is the full Unit Number of and Address. Unit will typically be imprted as a string and may include letters and numbers, however in common practice the unit type should be omitted. 

The unit tag will be ignored unless the `hasUnit="true"` attribute is set in the `<number>` tag.

**_City_**

The City Tag is required for all Addresses 

**_State/Province/Region_**

> `<state> / <prov> / <reg>`

The State Tag trio is interchangeable. One of this trio is required for all addresses. 

**_Country_**

The Country tag must be completed for all addresses. The country must match the SPAN1 Country Standards definition.  

## Header Tags







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

> `<spanOb version="1.0" type="resume">...</spanOb>`

## Standard Tags

A standard tag is a tag that may be utilzed within multiple element types in the same manner. Generally, standard tags must be a child of a parent element. For example, a name tag must be the child of an institution or person element. 

### Legal Name

> `<legalName>...</legalName>`

The Legal Name tag is used to indicate an entity’s legal name when that entity is not of the “People” type. The Legal Name tag can be set within the Candidate tag but is mandatory within the Issuer, Institution, and Employer tags.

The Legal Name tag is ignored when a Given Name / Family name are present within the same tag space.

### Contact

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

### Address

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

## Header

> `<head>...</head>`

The Header of a SpanObject contains all identifying information that applies to all aspects of the SpanObject. For Example a candidate’s name, contact information, and work authorizations.

### Candidate

> `<candidate>...</candidate>`

The Candidate tag is **ALWAYS** a part of the Header for `type="resume"` and `type="application"` SPAN Objects. The Candidate tag contains a candidate’s name and contact information.

### Authorizations

> `<authorization>...</authorization>`

The Authorization tag contains a candidate’s work authorizations, citizenship, and government issued licenses. This tag may also contain government clearances, and identity information. 

#### Authorization Tags

##### Common Attributes

The `country` attribute must be set for all Government tags. The country must match the SPAN1 Country Standards definition.

The state/prov/reg tag must be set when the authorization is issued by such. 

The `expires` attribute is required and must be set to either “true”/”false”.

The `sponsored` attribute is required and indicates that an employer sponsor is required to maintain the authorization. 

##### Government

> `<government country="..." type="..." expires="true/false" sponsored="true/false">...</government>`

The Government tag describes a Government type authorization, that is not a license. Government authorization “type” attributes include: 
- `citizenship` - Authorization due to Citizenship held by candidate.
- `resident` - Authorization obtained through Legal Permanent Residency or similar status. 
- `[Visa Code]` - A Visa Code can be used for certain visa types.
- `authorization` - Authorization granted due to short term work permit or similar status. 
- `clearance` - Government Issued Security Clearance

**NOTICE:** When no child tags are required the contents of the government tag must be “true”

##### License

> `<license country="..." state="..." countryrestricted="..." regionRestricted="..." type="..." expires="..." sponsored="...">...</license>`

The license tag is similar to the *Government* tag, and similarly has a nearly identical set of attributes. 

The license tag can be used for the following tag attributes: 
- driver - To identify a Driver License
- cdl - To identify a Commercial Driver License
- professional - To identify a license issued by a governing organization for a specific purpose. See *Professional License Notes* below for child tag requirements. 
- permit - To identify a short term permission similar to a `professional` type. See *Professional License Notes* below for child tag requirements.

**_Professional License Notes_**

When listing a `professional` license type, the following child tags are required. 

- `<issuer>...</issuer>` - The issuer tag is a parent to contain information about the organization issuing a license. The `<issuer>` tag can contain any standard `<contact>`, `<address>`, or `<url>` tags. **Note:** the `<legalname>` and `<gorg>` tags are always required. *GOrg* is `true` when the issuer is a government agency and `false` when the issuer is a non-governmental entity. 
- `<title>...</title>` - The official full-text title of the license. This is identical in usage to degrees and other children of the `<formation>` tag.
- `<start>...</start>` - The start date, or year of the current license. *See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 
- `<expire>...</expire>` - The expiration date, or year of the current license. **This tag is required when the `expires="true"` is utilized and ignored when the `expires="false"` attribute is used.** *See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 
- `<active>true/false</active>` - This is an optional tag that indicates if a license is active or inactive regarless of the expiration dates. 
- `<registration>...</registration>` - The registration tag is an optional tag for including a license number or other unique identifier. 

## Formation

> `<formation>...</formation>`

The formation tag is utilized to indicate academic and professional development experience. Formation objects include secondary and post-secondary education, professional education, certifications, and other credentials that may not be listed in the "Authorizations" containter.

### Credential

> `<credential type=... complete="true/false" level=...>...</credential>`

All Formation objects are of type `<credential>` the `type` attribute is used to differentiate between credential types. **All attributes are required for all objects.**

The allowable credential types are: 

- `education` - The education type is used to identify the completion of a program of study. Allowable levels for the education type are `secondary` - for High School and High School equivilent credentials (such as the GED), `university` - for Undergraduate and Graduate credentials, and `post` - for Post-Graduate credneitals (including: PhD, DEd, MD, and JD).
- `exam` - The exam type identifies certificaiton programs and other exams. The exam type supports two levels: `certification` - the general level, and `registry` - for exams that are closer to a licensure however are not issued by governmental organization. **NOTE:** _If an importer does not differentiate between the two levels, inputs must be accepted equally for both levels._
- `course` - The course type is used to identify professional education courses that do not produce a certification credneital. 

Credential objects require the following tags: 

#### Institution

> `<institution registered="false"></institution>`

The institution tag is used to identify the issuer of a credential. Currently the SPAN Alliance does not support a institution registry so the `registered` attribute, if included, must be set to `false`. When the registered attribute is set to false the `<legalName>...</legalName>` tag must be included within the institution tags. 

The institution tag allows the following supporting tags: `<region>`, `<city>`, `<state>`, `<address>`, `<url>`

#### Degree

> `<degree>...</degree>`

The degree tag is required for "education" credential types, and ignored for all other credential types. 

The degree tag should include the academic title for the dregree, not the program title (e.g. Master of Arts)

#### Title

> `<title>...</title>`

The title tag is required for all credential types except for "education" credential types with a level of "secondary".

##### Education Programs 

When referencing an educational program, the "title" tag should include the name of the specific program persued. (e.g. Literature). 

##### Exam Credentials 

When referencing an exam credential, the "title" tag should be the official title of the specific certification (not the associated initials) (e.g. "Project Management Professional" **NOT:** "PMP").

##### Course Credentials 

When referencing a professional education course, the "title" tag should include the full title of the course, as it appears in literature or on a transcript. 

#### Start

>`<start>...</start>`

The Start date is an _Optional_ field used to indicate when a program was begun. *See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 

#### Complete 

>`<complete expires="true/false">...</complete>`

The complete date is a _Recomended_ field used to indicate when a program was completed, or a credential obtained. The `expires` attribute is optional, when set to true: an additional `<expire>` tag is required, if set to false: the `<expire>` tag is actively ignored. If no `expires` attribute is included in the complete tag, the `<expire>` tag becomes optional, and an importer may chose to ignore it. 

*See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 

#### Expire

>`<expire>...</expire>`

_See "Complete" for information on how to use the `<expire>` tag._

#### Note 

>`<note>...</note>`

The note field is optional, and may be ignored by an importer at their discretion. The Note field allows free text in a "Single Line of Text" format to be included. 

#### URL

>`<url>...</url>`

The URL is an optional field, and may be ignored by an importer at their discretion. The URL, when included inside the `<credential>` tag is specific to that credential and should be utilized to provide a link to credential information, verification information, or the issuer. 

#### Education ONLY Tags

**_The Following Tags Apply Only to Education Type Credentials_**

#### Latin Honors 

>`<latin>...</latin>`

Latin honors, distinctions, and other honors that are added to an education credential should be included inside the `<latin>` tag. (e.g. Suma Cum Laude, With Distinction, Advanced Placement, etc.)

#### GPA 

>`<gpa scale="...">...</gpa>`

The GPA of an educational program can be included. The `scale` attribute can be used to identify an alternative GPA Scale. Without a `scale` attribute the GPA scale will be 0.00-4.00. 

**Importer Note:** GPAs must always be numeric values. Importers must accept a minimum of two (2) decimal places, and may truncate or round longer numbers, however a numeric value of less than 4.00 may not be ignored if an importer accepts GPA information.

## Experience

>`<experience>...</experience>`

Experience is a container for work experience and experience requirements. There are three available sub-tags within the `<experience>` tag space, each is identical with the exception of the use of a `type` tag for professional roles that is not available for internships and volunteer positions. 

### Experience Parent Tags

While SPAN supports multiple experience types, an importer must accept all tag types; however, an importer is not required to differentiate between the tag types.

#### Professional Role

>`<role type="...">...</role>`

The `<role>` tag is for referencing paid / professional level work. The `<role>` tag has an optional `type` attribute to indicate the role type as `"full"` - for fulltime, `"part"` - for part-time, `"hourly"` - for less than part-time hourly roles, and `"unpaid"` - for professional level volunteer work such as board memberships and executive roles in non-profit organizations. 

#### Internship

>`<internship>...</internship>`

The `<internship>` tag is used to indicate an internship held by a candidate. 

#### Volunteer

>`<volunteer>...</volunteer>`

The `<volunteer>` tag is used to describe volunteer experience obtained by a candidate. The use of this tag should typically imply that the role held todes not rise to the level of "professional level" experience.

### Employer

>`<employer registered="false"></employer>` 

The `<employer>` tag is required for all experience entries. Currently the SPAN Alliance does not support a employer registry so the `registered` attribute, if included, must be set to `false`. When the registered attribute is set to false the `<legalName>...</legalName>` tag must be included within the employer tags.

The emplopyer tag allows the following supporting tags: `<region>`, `<city>`, `<state>`, `<address>`, `<url>`

### Title

>`<title>...</title>`

The Title tag is a required field that is used to indicate the job or position title that is/was held in a particular position. 

### Start

>`<start>...</start>`

The Start date is a required entry indicating when a position was started. *See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 

### Complete

>`<complete>...</complete>`

The Complete date is an _optional_ field indicating the end of a position. **_NOTE:_** When the `<complete>` field is omitted, the Importer must accept the experience entry as "Current" or "to Present". *See "Dates" in the [SPAN Import/Export Framework](SPANImportExportFramework.md) for information on how date formats are handled.* 

### Duties

>`<duties format="...">...</duties>`

The `<duties>` element is used to describe the specifics of an experience. The `<duties>` tag requires a `format` attribute  from the options outlined in this section. 

#### Narrative 

>`<duties format="narrative>...</duties>"`

The Narrative format allows for a free-text string to be provided. This field accepts only unformatted text. An importer must accept a minimum of 3000 charecters and may chose to truncate overruns. 

#### Bullet

>`<duties format="bullet">`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; `<it>...</it>`
>
>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; `<it>...</it>`
>
>`</duties>`

The bullet format allows for a bulleted representation of duties to be provided. Each bullet must be surrounded by an item (`<it>...</it>`) tag. Importers must accept a minimum of 3000 charecters in the composite of all items with a single charachter bullet added to the beginning of each item. 


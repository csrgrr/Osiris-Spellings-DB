# Osiris-Spellings-DB

![image](https://user-images.githubusercontent.com/104082439/210774912-9d7eee96-f8f9-4170-8058-1a836a7e15f4.png)

The following database includes the location of all the spellings of the name of Osiris in the CTs (Coffin Texts), collected in the volumes of De Buck(De Buck, A. 1935-1961. _The Egyptian Coffin Texts I-VII (OIP 24, 49, 64, 67, 73, 81 & 87)_. Chicago: University of Chicago Press.) and Allen (Allen, J.P. & De Buck, A. 2006._The Egyptian Coffin Texts. Vol. VIII: Middle Kingdom copies of pyramid texts_. Chicago: University of Chicago Press.). 

These data will be used for the creation of a __research tool__ that allows comparing these data.

__These data allow us to know:__
- Volume
- Page
- Section
- Type of Spelling
- Composition of the Spelling (Manuel de Codage)
- Formula (distinguishing between CT and PT)
- If it is the location wsir NN pn/tn
- If it is the name of the god wsir
- Document
- Document type
- Position in the document
- Archaeological location

### Position codes:

- Head = H
- Foot = F
- Back = B
- Top = L
- Front = Fr
- Bottom = Bo
- Side = S
- Others(example: canoptic box) = X
- Fragments and unknowns = 'unknown'


### How to import:
You can import the .sql file directly into your preferred Database Manager or run the PHP files used to create this db.
We do not recommener to use the PHP files for this purpose, since some changes have been made manually on the db.

### TO DO:
- Testing


### Disclaimer:
If you intend to use this database for research, you must take into account that the position in the document is not included in those cases belonging to vol. VIII. In other cases it is not known either for various reasons and it will appear designated as _unknown_.\
In cases where the document time is unknown, it will be marked with a _?_.\
If the _spell_ value in the table _spelling_ is __1__, it means that the spell is _unknown_.\
In any case, you also have to take into account possible human error, so we recommend __double-checking__ the results.

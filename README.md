# Project_2
## Tasks


Advisors

NAME
The advisors want two more data points added somewhere to the DB, where their respective offices are located, and where they will meet with their student. When a student signs up for an appointment, this data should also show.

NAME
The “work screen” (or where work shows up) is too skinny, make larger or replace so text takes up more space.

Administration

NAME
The overall pages are ugly. You may add different colors.

NAME
All footers should be an inserted “include” so if a change needs to happen, all pages change.

ELISHA
The number of $_SESSION variables is way too high. Eliminate all but ‘userID’. If needed, some others can stay with negotiation. The rest can pull info from the DB when needed. This is a major code addition.

## Tasks Compelte

- [ ] DB Data Pts
- [ ] Work Screen Fix
- [ ] CSS Change
- [x] To Many Session

## Issues

:exclamation: 
:::
:: What I did was reduce $_SESSIONS by making all SESSIONS into ONE SESSION:array.
:: I call the DB only once in the begining. 
:: i.e $_SESSION["userId"][X]
::X=1 is first name etc
:::
:: Rubric says "rest can pull info from the DB when needed."
:: Does this mean that each time I need a value, I have to call DB?
:: I did not go this route because it would only add more redundant code (calling DB in each file)
:::
:exclamation: 

:exclamation: 
::Since we have different DB, current version of git will not work with all
:::
::::Main changes: 
::password/login in commonmethods
::proj2advisors::
-- Location vs RoomNumber
:exclamation: 


## Original Code Issues

- Some of the original code needed work:

src/AdminPrintSchedule.php -- 
src/AdminScheduleApp.php -- forgot to close comment, which hid submit button
src/AdminSearchApp.php -- wrong type of comment, printed out to webpage

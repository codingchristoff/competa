# Rubric Management Tool for Schools

## Description
---

Based on a brief provided by Michiel from Competa asked us to create a piece of software which could be easily accessed by students, teachers and administrators.

We have chosen to develop a web application using a combination of PHP, SQL, HTML and CSS.

The aim of the software was to modernise the process of Dutch students filling out self-assessment rubrics throughout the year.

Our development team have been able to create a full process from start to finish for all the basic requirements. 

Admins can manage users, classes and rubrics.  
Teachers can manage their table groups and assign rubrics to a student or to their entire class.  
Students are able to view rubrics which have been assigned to them, are able to complete those rubrics and retrieve the results of rubrics which have been completed for them. 

---

## Admin Summary

- Once logged in admin's will be greeted with a home page message.
- They can view their own data.
- They can view/edit/delete/add other users.
- View Students in a specific class.
- Manage rubrics

## Teacher Summary
- Once logged in teachers are greeted by a welcome page. 
- View own data
- View/Edit students
- Search/Assign rubrics

## Student Summary

 - Once logged in a student will be directed to their home page which displays a list of rubrics (assessments) which the student needs to complete. 
 - Complete the assigned rubrics
 - View rubrics which have been completed for them.

## Instructions
---

To avoid repitition I have indicated using the following abbreviations to denote who can access what features:

- Admin `A`
- Teacher `T`
- Student `S`

### View Personal Data `A T S`

1. Select 'My Data' from the navbar.

### Manage User

#### View User `A T`

1. From the navbar select 'Manage User' > 'View User'
2. Search for user by their username.

Alternatively

1. Select 'View all users' to display all users.

*Future Updates*

Allow for search to return values like the search term.

#### Add User `A`

1. From the navbar select 'Manage User' > 'Add User'
2. Fill the form.
3. Click 'Create User' to create user. 

#### Edit User `A T`

1. From the navbar select 'Manage User' > 'Edit User'
2. Search for the user by using their username.
3. Edit the relevant fields.
4. Click 'Edit User'.

#### Delete User `A`

1. From the navbar select 'Manage User' > 'Delete User'
2. Search for the user by using their username.
3. Click 'Delete User' to delete user.

#### View Students in a Class on Teacher `A`

1. From the navbar select 'Manage User' > 'View Teacher Class'
2. Search for the teacher username.

*Future Updates*

Allow for search to return values like the search term.

### Manage Class

#### Assign Table Group `A T`

1. From the navbar select 'Manage Class' > 'Assign Table Group'.
2. Search for the student on username.
3. Select the table group they are to be assigned to.
4. Click 'Assign Table Group'.

#### Add Class `A`

1. From the navbar select 'Manage Class' > 'Add Class'
2. Enter the class name you wish to create.
3. Click 'Add Class'.

#### Delete Class `A`

1. From the navbar select 'Manage Class' > 'Delete Class'
2. Enter the class name you wish to delete.
3. Click 'Delete Class'.

### Manage Rubric

#### Rubric Generator `A`

1. From the navbar select 'Manage Rubric' > 'Rubric Generator'.
2. Select the size you require from the drop downs.
3. Click 'Submit'.
4. Fill in the information as required. 
5. Click 'Create' to create the rubric.

#### Rubric Search `A T`

1. From the navbar select 'Manage Rubric' > 'Rubric Search'.
2. Enter the name of the rubric you wish to view and press enter.
3. Click view on the relevant card to display the rubric.

#### Assign Rubric `T`

A teacher can either assign to a class or an individual student.

1. From the navbar select 'Manage Rubric' > 'Rubric Search'.
2. Search for the rubric name and press enter.
3. Select view on the correct card.
4. To assign:
   1. to a student enter their username in the field.
   2. to a class just press 'Assign'.  

### Completing Rubrics

#### Complete an Assessment `S`

 1. Navigate to homepage.
 2. Select the assessment you wish to complete by clicking the corresponding assess button on the card.
 3. The page should now load a rubric which will need to be completed.
 4. Select the grading for each category by selecting the corresponding radio button.
 5. To submit the grading click 'SUBMIT'.
 6. The page will now reload and take the user back to the home page.

#### View Assessment Results `S`

1. Select 'Results' from the nav bar.
2. Select view to see the completed rubric.

*Future Updates*

User will only be able to see results once all assessments for round / table group has been completed.







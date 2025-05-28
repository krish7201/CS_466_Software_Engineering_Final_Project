
class Course {
    constructor(courseId,courseTitle, credits, cost, description, instructor, semester, year, institution, department) {
        this.courseId = courseId;
        this.courseTitle = courseTitle;
        this.credits = credits;
        this.cost = cost;
        this.description = description;
        this.instructor = instructor;
        this.semester = semester;
        this.year = year;
        this.institution = institution;
        this.department;
    }

}

class Person {
        constructor(userID, firstName, lastName, accessLevel) {
            this.userID = userID;
            this.firstName = firstName;
            this.lastName = lastName;
            this.accessLevel = accessLevel;
        }
}




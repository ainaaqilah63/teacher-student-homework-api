# teacher-student-homework-api
My technical assessment

Stories:
```
1. As a teacher/student, I want to be able to login to create or update any homework.

Endpoint: POST http://localhost:8000/api/login

Headers: Content-Type: multipart/form-data

username: hidayah
password: password024

Response: HTTP Code 200
```


```
2. As a teacher/student, I will also be able to logout from the system.

LOGIN:
Endpoint: POST http://localhost:8000/api/logout

Headers: Content-Type: application/json

Steps:
1. Launch Postman.
2. Copy the token provided once you login in Stories 1.
3. On the Authorization tab, select Authorization type “Bearer Token” and provide the value for the Bearer Access Token you just obtained.

Response: HTTP Code 200
```


```
3. As a teacher, I want to be able to create new homework with/without student assigned.

Endpoint: POST http://localhost:8000/api/teacher/create-homework
Headers: Content-Type: application/json

On the Authorization tab, select Authorization type “Bearer Token” and provide the value for the Bearer Access Token you have obtained.

Example 1:
Request: POST http://localhost:8000/api/teacher/create-homework
Request JSON:
{
    "teacher_name": "Hidayah Ishak",
    "student_name": "Aina Aqilah",
    "title": "English Assignment Test",
    "description": "Complete exercises 1-15.",
    "due_date": "01-12-2023"
}

Response JSON:
{
    "message": "Homework created successfully",
    "data": {
        "homework": {
            "teacher_id": 4,
            "student_id": 1,
            "title": "English Assignment Test",
            "description": "Complete exercises 1-15.",
            "due_date": "2023-12-01",
            "status": "pending",
            "updated_at": "2023-11-25T11:55:17.000000Z",
            "created_at": "2023-11-25T11:55:17.000000Z",
            "id": 11
        }
    }
}

Response: HTTP Code 201



Example 2:
Request: POST http://localhost:8000/api/teacher/create-homework
Request JSON:
{
    "teacher_name": "Hidayah Ishak",
    "student_name": "",
    "title": "Math Assignment Test",
    "description": "Complete exercises 20-22.",
    "due_date": "01-12-2023"
}

Response JSON:
{
    "message": "Homework created successfully",
    "data": {
        "homework": {
            "teacher_id": 4,
            "student_id": null,
            "title": "Math Assignment Test",
            "description": "Complete exercises 20-22.",
            "due_date": "2023-12-01",
            "status": "pending",
            "updated_at": "2023-11-25T11:55:17.000000Z",
            "created_at": "2023-11-25T11:55:17.000000Z",
            "id": 11
        }
    }
}

Response: HTTP Code 201
```


```
4. As a teacher, I want to be able to assign a homework to multiple students.

Endpoint: POST http://localhost:8000/api/teacher/assigned-homework
Headers: Content-Type: application/json

On the Authorization tab, select Authorization type “Bearer Token” and provide the value for the Bearer Access Token you have obtained.

Request JSON:
{
  "homeworks": [
    {
      "title": "Science Assignment",
      "description": "Complete exercises 1-10.",
      "due_date": "10-12-2023",
      "status": "pending",
      "teacher_name": "Hidayah Ishak",
      "students": [
        {
          "name": "Aina Aqilah"
        },
        {
          "name": "Letchumy a/p Subramaniam"
        }
      ]
    }
  ]
}

Response JSON:
{
    "message": "Homework assigned successfully",
    "data": [
        {
            "id": 12,
            "teacher_id": 4,
            "student_id": 1,
            "title": "Science Assignment",
            "description": "Complete exercises 1-10.",
            "due_date": "2023-12-10 00:00:00",
            "status": "pending",
            "created_at": "2023-11-25T12:01:47.000000Z",
            "updated_at": "2023-11-25T12:01:47.000000Z",
            "student": {
                "id": 1,
                "name": "Aina Aqilah",
                "role_id": 2,
                "username": "aaina",
                "email": "ainaaqilah@gmail.com",
                "phone_no": "0123456789",
                "created_at": "2023-11-24T05:08:34.000000Z",
                "updated_at": "2023-11-24T05:08:34.000000Z"
            }
        },
        {
            "id": 13,
            "teacher_id": 4,
            "student_id": 2,
            "title": "Science Assignment",
            "description": "Complete exercises 1-10.",
            "due_date": "2023-12-10 00:00:00",
            "status": "pending",
            "created_at": "2023-11-25T12:01:47.000000Z",
            "updated_at": "2023-11-25T12:01:47.000000Z",
            "student": {
                "id": 2,
                "name": "Letchumy a/p Subramaniam",
                "role_id": 2,
                "username": "letchumy",
                "email": "amalamathi@gmail.com",
                "phone_no": "0126534273",
                "created_at": "2023-11-24T05:08:34.000000Z",
                "updated_at": "2023-11-24T05:08:34.000000Z"
            }
        }
    ]
}

Response: HTTP Code 201
```

```
5. As a student, I should be able to retrieve all homework assigned to me.

Endpoint: GET http://localhost:8000/api/student/list-homework
Headers: Content-Type: application/json

Steps:
1. Launch Postman.
2. Copy the token provided once you login as student in Stories 1.
3. On the Authorization tab, select Authorization type “Bearer Token” and provide the value for the Bearer Access Token you just obtained.

Response JSON:
{
    "homeworks": [
        {
            "id": 11,
            "teacher_id": 4,
            "student_id": 1,
            "title": "English Assignment Test",
            "description": "Complete exercises 1-15.",
            "due_date": "2023-12-01 00:00:00",
            "status": "pending",
            "created_at": "2023-11-25T11:55:17.000000Z",
            "updated_at": "2023-11-25T11:55:17.000000Z"
        },
        {
            "id": 12,
            "teacher_id": 4,
            "student_id": 1,
            "title": "Science Assignment",
            "description": "Complete exercises 1-10.",
            "due_date": "2023-12-10 00:00:00",
            "status": "pending",
            "created_at": "2023-11-25T12:01:47.000000Z",
            "updated_at": "2023-11-25T12:01:47.000000Z"
        }
    ]
}

Response: HTTP Code 200
```


```
6. As a student, I should be able to update homework status to submitted.

Endpoint: GET http://localhost:8000/api/student/submit-homework/{homeworkId}
Headers: Content-Type: application/json

On the Authorization tab, select Authorization type “Bearer Token” and provide the value for the Bearer Access Token you have obtained.

Request JSON:
{
    "id" : 12,
    "status" : "submitted"
}

Response JSON:
{
    "message": "Homework status updated succesfully.",
    "data": {
        "homework": {
            "id": 12,
            "teacher_id": 4,
            "student_id": 1,
            "title": "Science Assignment",
            "description": "Complete exercises 1-10.",
            "due_date": "2023-11-25 20:19:25",
            "status": "submitted",
            "created_at": "2023-11-25T12:01:47.000000Z",
            "updated_at": "2023-11-25T12:19:25.000000Z"
        }
    }
}

Response: HTTP Code 200
```
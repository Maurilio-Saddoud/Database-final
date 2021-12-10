DROP DATABASE IF EXISTS ClassQuestions;
CREATE DATABASE ClassQuestions;
USE ClassQuestions;

CREATE TABLE Class (
    class_id    INT,
    class_title VARCHAR(100),
    semester    VARCHAR(1), -- Denoted S for spring and F for fall
    classYear   YEAR,
    PRIMARY KEY (class_id)
);

CREATE TABLE Questions (
    Q_id        INT AUTO_INCREMENT, -- autoincremented
    Q_prompt    VARCHAR(200),
    Q_type      VARCHAR(2), -- Free Response (FR), multiple choice (MC), Yes/NO (YN)
    Q_date      DATE,
    class_id    INT,
    FOREIGN KEY (class_id) REFERENCES Class(class_id),
    PRIMARY KEY  (Q_id)
);

CREATE TABLE Answers (
    Q_id        INT,
    student_id  INT,
    answer_code  INT, -- use type in order to interpret the code, based on student repsonse
    FOREIGN KEY (Q_id) REFERENCES Questions(Q_id),
    PRIMARY KEY (Q_id, student_id) -- allows only one answer per question per student
);

CREATE TABLE FreeResponse (
    answer      VARCHAR(500),
    Q_id        INT,
    FOREIGN KEY (Q_id) REFERENCES Questions(Q_id)
);

CREATE TABLE MCAnswers (
    answerchoice  VARCHAR(100),
    Q_id          INT,
    answer_code   INT, -- A -> 1, B-> 2 etc.
    FOREIGN KEY (Q_id) REFERENCES Questions(Q_id)
);


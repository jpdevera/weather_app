# WEATHER APPLICATION
Native PHP using MVC pattern and bower to manage assets

# INSTRUCTION 
Please read and setup properly the config file at `config/config.php`<br/>

Installation<br/>
setup config if necessary at `config/config.php`<br/>

# EXPLANATION
I'm not that good in designing, but I implemented mvc and oop pattern in this examination.


# MySQL
1. 
SELECT 
	CONCAT('T',LPAD(A.id, 11, 0)) ID,
    A.nickname Nickname,
    CASE 
		WHEN A.status = 0 THEN 'Discontinued'
        WHEN A.status = 1 THEN 'Active'
        WHEN A.status = 2 THEN 'Deactivated'
    END `Status`,
	GROUP_CONCAT(
		CASE 
		WHEN B.role = 1 THEN 'Trainer'
        WHEN B.role = 2 THEN 'Assessor'
        WHEN B.role = 3 THEN 'Staff'
    END SEPARATOR '/') `Roles`
FROM trn_teacher A
JOIN trn_teacher_role B ON A.id=B.teacher_id
GROUP BY A.id
ORDER BY A.nickname;

2. 
SELECT 
	A.id ID,
    A.nickname Nickname,
    IFNULL(C.`Open`,0) `Open`,
    IFNULL(D.Reserved,0) Reserved,
    IFNULL(E.Taught,0) Taught,
	IFNULL(F.NoShow,0) NoShow
FROM trn_teacher A
JOIN trn_teacher_role B ON A.id=B.teacher_id
LEFT JOIN (
	SELECT teacher_id, COUNT(teacher_id) `Open`
	FROM trn_time_table 
	WHERE status=1
	GROUP BY teacher_id
)C ON A.id=C.teacher_id
LEFT JOIN (
	SELECT teacher_id, COUNT(teacher_id) Reserved
	FROM trn_time_table 
	WHERE status=3
	GROUP BY teacher_id
)D ON A.id=D.teacher_id
LEFT JOIN (
	SELECT teacher_id, COUNT(teacher_id) Taught
	FROM trn_evaluation 
	WHERE result=1
	GROUP BY teacher_id
)E ON A.id=E.teacher_id
LEFT JOIN (
	SELECT teacher_id, COUNT(teacher_id) NoShow
	FROM trn_evaluation 
	WHERE result=2
	GROUP BY teacher_id
)F ON A.id=F.teacher_id
WHERE A.status IN (1,2) 
	AND B.role IN (1,2)
GROUP BY ID
ORDER BY A.nickname;
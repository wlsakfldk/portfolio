/*아이디
이름
이메일
패스워드
패스워드 확인
*/

create table register(
	num int not null auto_increment,
	id char(15) not null,
	pass char(20) not null,
	name char(15) not null,
	email char(80) not null,
	register_day char(20),
	primary key(num)
) charset=utf8;
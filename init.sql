use classroom;

drop table if exists students;
drop table if exists dai;
drop table if exists shityou;
drop table if exists multi;
drop table if exists seminar;
drop table if exists available_time;

create table students(
  student int primary key,
  classroom int default 0 not null
);

create table dai(
  student int not null,
  enter_time time,
  exit_time time
);

create table shityou(
  student int not null,
  enter_time time,
  exit_time time
);

create table multi(
  student int not null,
  enter_time time,
  exit_time time
);

create table seminar(
  student int not null,
  enter_time time,
  exit_time time
);

create table available_time(
  classroom int not null,
  the_date date,
  start_time time,
  end_time time
);



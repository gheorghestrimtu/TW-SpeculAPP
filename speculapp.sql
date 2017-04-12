set serveroutput on;

drop table Currency;
create table Currency(curr_ID int primary key,trigramm char(3) not null, exchange_rate float(7) not null);
drop table Users;
create table Users(user_ID int primary key, first_name varchar(20) not null, last_name varchar(20) not null, email varchar(40) unique not null, password varchar(15) not null)
drop table Sesion;
create table Sesion(sesion_ID int primary key, user_ID int references Users(user_ID) on delete cascade, starttime date not null, endtime date not null)
drop table Game;
create table Game(game_ID int primary key, sesion_ID int references Sesion(sesion_ID) on delete cascade, user_ID int references Users(user_ID),
                    outcome int check(outcome in (0,1,2)) not null, total_sum float(10) , usd_sum float(10), eur_sum float(10), ron_sum float(10))
drop table Transaction;
create table Transaction(transaction_ID int primary key, sesion_ID int references Sesion(sesion_ID) on delete cascade, game_ID int references Game(game_ID) on delete cascade,
            user_ID int references Users(user_ID) on delete cascade, curr_ID1 int references Currency(curr_ID), curr_ID2 references Currency(curr_ID), 
            sum1 float(10), sum2 float(10), timp date not null)
drop table Top_traders;
create table Top_traders(user_ID int references Users(user_ID), game_ID int references Game(game_ID))

insert into Currency values (1, 'RON', 1.0);
insert into Currency values (2, 'USD', 4.2673);
insert into Currency values (3, 'EUR', 4.5538);

select * from Currency;

insert into Users values(1, 'Gheorghe', 'Strimtu', 'gheorghe.strimtu@yahoo.com', 'superdulce');
insert into Users values(2, 'Iaroslav', 'Mazur', 'iaroslav.mazur@yahoo.com', 'liptonceai');
insert into Users values(3, 'Ion', 'Paladie', 'ion.paladie@yahoo.com', 'cintaretul');
insert into Users values(4, 'Johhny', 'Depp', 'johnny.depp@yahoo.com', 'actorul');
insert into Users values(5, 'Bill', 'Gates', 'bill.gates@yahoo.com', 'bogatul');
insert into Users values(6, 'Albert', 'Einstein', 'albert.einstein@yahoo.com', 'geniul');

DECLARE
    v_contor INTEGER:=0;
    v_datestart DATE;
    v_dateend DATE;
    v_min INTEGER;
    v_max INTEGER;
    v_random INTEGER;
BEGIN
   select min(user_ID) into v_min from Users;
   select max(user_ID) into v_max from Users;
   
   WHILE(v_contor<10000) LOOP
   select sysdate into v_datestart from dual;
   v_random:=TRUNC(DBMS_RANDOM.VALUE(v_min,v_max+1));
   select sysdate into v_dateend from dual;
   insert into Sesion values(v_contor, v_random, v_datestart, v_dateend);
   v_contor:=v_contor+1;
   END LOOP; 
END;

select * from Sesion order by sesion_id;

DECLARE
    v_contor INTEGER:=0;
    v_minsesionid INTEGER;
    v_maxsesionid INTEGER;
    v_minuserid INTEGER;
    v_maxuserid INTEGER;
    v_randomsesionid INTEGER;
    v_randomuserid INTEGER;
    v_sum INTEGER;
    v_outcome INTEGER;
BEGIN
   select min(user_ID) into v_minuserid from Users;
   select max(user_ID) into v_maxuserid from Users;
   select min(sesion_ID) into v_minsesionid from Sesion;
   select max(sesion_ID) into v_maxsesionid from Sesion;
   WHILE(v_contor<10000) LOOP
   v_randomsesionid:=TRUNC(DBMS_RANDOM.VALUE(v_minsesionid,v_maxsesionid+1));
   v_randomuserid:=TRUNC(DBMS_RANDOM.VALUE(v_minuserid,v_maxuserid+1));
   v_sum:=TRUNC(DBMS_RANDOM.VALUE(1000,2000+1));
   v_outcome:=TRUNC(DBMS_RANDOM.VALUE(0,2+1));
   insert into Game values(v_contor,v_randomsesionid,v_randomuserid,v_outcome,v_sum,0,0,0);
   v_contor:=v_contor+1;
   END LOOP; 
END;
select * from Game order by game_id;

create or replace FUNCTION number_of_sessions(
    uid users.user_id%type)
  RETURN NUMBER
AS
  v_count int;
BEGIN
  select count(*) into v_count from sesion where user_id=uid;
  RETURN v_count;
END;

CREATE OR REPLACE PACKAGE BODY manager_sesiune
IS
  FUNCTION number_of_sessions(
      uid users.user_id%type)
    RETURN NUMBER
  AS
    v_count INT;
  BEGIN
    SELECT COUNT(*) INTO v_count FROM sesion WHERE user_id=uid;
    RETURN v_count;
  END number_of_sessions;
  PROCEDURE insert_session(
      sid sesion.sesion_id%type,
      uid users.user_id%type)
  IS
    v_datestart DATE;
  BEGIN
    SELECT sysdate INTO v_datestart FROM dual;
    INSERT INTO Sesion VALUES
      (sid, uid, v_datestart, v_datestart
      );
  END insert_session;
END manager_sesiune;
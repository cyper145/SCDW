delimiter //

create procedure encuentros(in partido varchar(8))
begin
   
    create temporary table resumen(
        codequipo varchar(8) NOT NULL,
        idequipoenpartido int(4) NOT NULL,
        codpartido varchar(8) NOT NULL,
        nombreEquipo varchar(25) NOT NULL
        
    );
    -- inserto datos en la tabla resumen
    insert into resumen(codequipo ,idequipoenpartido, codpartido ,nombreEquipo )
        select O.codequipo,E.idequipoenpartido,P.codpartido, O.nombre
            from tequipoenpartido as E
            join tpartido as P on E.codpartidoo = P.codpartido
            join tequipo as O on E.codequipo = O.codequipo
            where P.codpartido=partido
            ;
 select * from resumen;
      drop table resumen;
 end //

delimiter ;


delimiter //
create procedure resumen_asistente(in pid_reunion int(4) )
begin
   
    create temporary table resumen(
        id_asistente int(4) NOT NULL,
        id_docente varchar(8) NOT NULL,
        id_reunion int(4) NOT NULL,
        nombre varchar(25) NOT NULL,
        apellidopaterno varchar(25) NOT NULL,
        apellidomaterno varchar(25) NOT NULL
        
    );
    -- inserto datos en la tabla resumen
    insert into resumen(id_asistente,id_docente ,id_reunion, nombre  ,apellidopaterno,apellidomaterno)
        select a.idasistente,d.coddocente ,r.idreunion, d.nombre  ,d.apellidopaterno,d.apellidomaterno
            from tasistente as a
            join tdocente as d on a.coddocente = d.coddocente
            join treunion as r on a.idreunion = r.idreunion
            where a.idreunion=pid_reunion;
      select * from resumen;
      drop table resumen;
end //

delimiter; 

delimiter //

create procedure resumen_conclusion(in pid_reunion int(4) )
begin
   
    create temporary table resumen(
        id_conclusion int(4) NOT NULL ,
        id_agenda int(4) NOT NULL,
        id_reunion int(4) NOT NULL,
        conclusion varchar(120) NOT NULL,
        fecha date NOT NULL
    
    );
    -- inserto datos en la tabla resumen
    insert into resumen(id_conclusion,id_agenda ,id_reunion , conclusion ,fecha  )
            
            select c.nroconclusion,a.nroagenda ,r.idreunion , c.conclusion ,r.fecha 
            from tconclusion as c
            join tagenda as a on c.nroagenda = a.nroagenda
            join treunion as r on a.idreunion = r.idreunion
            where r.idreunion=pid_reunion;
      select * from resumen;
      drop table resumen;
end //

delimiter ; 
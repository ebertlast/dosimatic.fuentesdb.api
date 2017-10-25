DROP PROCEDURE IF EXISTS pa_usuarios;
DELIMITER $$
CREATE PROCEDURE pa_usuarios
(
)
BEGIN
  SELECT usuario,pnombre,snombre,papellido,sapellido,masculino,usuario.perfilid,denominacion as perfil 
   FROM `usuario` INNER JOIN `perfil` ON `perfil`.`perfilid` = `usuario`.`perfilid` 
   WHERE 1;
END $$
DELIMITER ;
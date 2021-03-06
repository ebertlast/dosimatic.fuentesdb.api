DROP PROCEDURE IF EXISTS pa_usuarios;
DELIMITER $$
CREATE PROCEDURE pa_usuarios
(
  IN _usuario VARCHAR(100)
)
BEGIN
  SELECT usuario,pnombre,snombre,papellido,sapellido,masculino,usuario.perfilid,denominacion as perfil 
   FROM `usuario` INNER JOIN `perfil` ON `perfil`.`perfilid` = `usuario`.`perfilid` 
   WHERE usuario=CASE WHEN _usuario='' THEN usuario ELSE _usuario END;
END $$
DELIMITER ;
DROP PROCEDURE IF EXISTS pa_ingresar;
DELIMITER $$
CREATE PROCEDURE pa_ingresar
(
    IN _usuario VARCHAR(100),
    IN _clave VARCHAR(100)
)
BEGIN
  SELECT usuario,pnombre,snombre,papellido,sapellido,masculino,usuario.perfilid,denominacion as perfil 
   FROM `usuario` INNER JOIN `perfil` ON `perfil`.`perfilid` = `usuario`.`perfilid` 
   WHERE usuario=_usuario AND clave=MD5(_clave);
END $$
DELIMITER ;
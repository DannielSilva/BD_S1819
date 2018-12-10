CREATE OR REPLACE FUNCTION chk_solicita()
RETURNS TRIGGER AS $BODY$
BEGIN

    IF NOT EXISTS(
        select * from eventoEmergencia E, (
            select numProcessoSocorro
            from audita
            where idCoordenador = 1
            ) B
        where moradaLocal = 'Cartaxo'
            and E.numProcessoSocorro = B.numProcessoSocorro;

        )

    THEN
        RAISE EXCEPTION 'Coordenador % nao auditou meios para este local', new.idCoordenador
        USING HINT = "Verifique ID do coordenador";
    END IF;


END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER chk_solicita AFTER INSERT ON solicita
FOR EACH ROW EXECUTE PROCEDURE chk_solicita();

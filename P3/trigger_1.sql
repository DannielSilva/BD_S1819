DROP TRIGGER IF EXISTS chk_solicita_trigger ON solicita;

CREATE OR REPLACE FUNCTION chk_solicita()
RETURNS TRIGGER AS $BODY$
DECLARE local_s VARCHAR(80);

BEGIN
    SELECT  moradaLocal INTO local_s
    FROM vigia
    WHERE numCamara = new.numCamara;
    IF NOT EXISTS(
        select * from eventoEmergencia E, (
            select numProcessoSocorro
            from audita
            where idCoordenador = new.idCoordenador
            ) B
        where moradaLocal = local_s
            and E.numProcessoSocorro = B.numProcessoSocorro

        )

    THEN
        RAISE EXCEPTION 'Coordenador % nao auditou meios para este local', new.idCoordenador;
    END IF;
    RETURN NULL;


END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER chk_solicita_trigger AFTER INSERT ON solicita
FOR EACH ROW EXECUTE PROCEDURE chk_solicita();

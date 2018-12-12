DROP TRIGGER IF EXISTS chk_alocado_trigger ON alocado;

CREATE OR REPLACE FUNCTION chk_alocado()
RETURNS TRIGGER AS $BODY$


BEGIN
    IF NOT EXISTS (
        select 1 from (
            select numProcessoSocorro from acciona
            where numMeio = new.numMeio and nomeEntidade = new.nomeEntidade
        )as b where numProcessoSocorro = new.numProcessoSocorro

    )

    THEN
        RAISE EXCEPTION 'Meio % - % não foi alocado antes no processo %.', new.numMeio , new.nomeEntidade, new.numProcessoSocorro;
    END IF;
    RETURN NULL;


END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER chk_alocado_trigger AFTER INSERT ON alocado
FOR EACH ROW EXECUTE PROCEDURE chk_alocado();

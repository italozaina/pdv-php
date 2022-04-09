CREATE TRIGGER IF NOT EXISTS debita_qtde AFTER INSERT ON linha_fatura
BEGIN
 UPDATE item SET qtde_estoque = qtde_estoque - NEW.quantidade WHERE id=NEW.item_id AND qtde_estoque > 0 AND qtde_estoque >= NEW.quantidade;
END;

CREATE TRIGGER IF NOT EXISTS credita_qtde AFTER DELETE ON linha_fatura
BEGIN
 UPDATE item SET qtde_estoque = qtde_estoque + OLD.quantidade WHERE id=OLD.item_id;
END;
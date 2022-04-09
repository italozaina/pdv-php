CREATE TABLE IF NOT EXISTS usuario (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  sobrenome TEXT NOT NULL,
  login TEXT NOT NULL UNIQUE,  
  senha TEXT NOT NULL,
  acesso INTEGER,
  ativo INTEGER
);

CREATE TABLE IF NOT EXISTS categoria (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  ativo INTEGER
);

CREATE TABLE IF NOT EXISTS item (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  categoria_id INTEGER NOT NULL,
  codigo TEXT NOT NULL UNIQUE,
  nome TEXT NOT NULL,
  valor_compra REAL,
  valor_venda REAL NOT NULL,
  qtde_estoque INTEGER,
  qtde_minima INTEGER,  
  ativo INTEGER,
  FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE IF NOT EXISTS cliente (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  sobrenome TEXT NOT NULL,
  cpf VARCHAR(11) NOT NULL UNIQUE,
  dt_nascimento DATE,
  saldo REAL DEFAULT 0.0,
  ativo INTEGER
);

CREATE TABLE IF NOT EXISTS fatura (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  dt_fatura DATETIME DEFAULT (DATETIME(CURRENT_TIMESTAMP, 'localtime')),
  usuario_id INTEGER NOT NULL,
  cliente_id INTEGER,
  forma_pgto1 INTEGER,
  valor_pgto1 REAL,
  forma_pgto2 INTEGER,
  valor_pgto2 REAL,
  forma_pgto3 INTEGER,
  valor_pgto3 REAL,
  bandeira_cartao INTEGER,
  vezes_cartao INTEGER,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id),
  FOREIGN KEY (cliente_id) REFERENCES cliente(id)
);

CREATE TABLE IF NOT EXISTS linha_fatura (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  fatura_id INTEGER NOT NULL,
  item_id INTEGER NOT NULL,
  valor REAL NOT NULL,  
  quantidade INTEGER NOT NULL DEFAULT '1',
  desconto REAL NOT NULL DEFAULT '0.0',
  FOREIGN KEY (fatura_id) REFERENCES fatura(id),
  FOREIGN KEY (item_id) REFERENCES item(id)
);
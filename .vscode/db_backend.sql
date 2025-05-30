CREATE TABLE produtos(
    id_produto INT PRIMARY KEY AUTO_INCREMENT,
    produto CHAR(100) NOT NULL,
    descricao TEXT,
    id_marca INT NOT NULL,
    imagem char(80),
    quantidade INT NOT NULL,
    preco DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (id_marca) REFERENCES marcas(id_marca)
);
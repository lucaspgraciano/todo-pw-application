CREATE TABLE IF NOT EXISTS Tarefas (
                conteudo TEXT NOT NULL,
                titulo TEXT NOT NULL,
                email TEXT NOT NULL,
                estado TEXT NOT NULL,
                PRIMARY KEY(conteudo, titulo, email)
            );
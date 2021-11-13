CREATE TABLE IF NOT EXISTS Listas (
                titulo TEXT NOT NULL,
                email TEXT NOT NULL,
                visibilidade INTEGER NOT NULL,
                PRIMARY KEY(titulo, email)
            );
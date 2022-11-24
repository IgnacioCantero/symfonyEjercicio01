<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121184254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juguetes (id INT AUTO_INCREMENT NOT NULL, publico_objetivo_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, marca VARCHAR(255) NOT NULL, INDEX IDX_301CB412E90161FC (publico_objetivo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publico_objetivo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juguetes ADD CONSTRAINT FK_301CB412E90161FC FOREIGN KEY (publico_objetivo_id) REFERENCES publico_objetivo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juguetes DROP FOREIGN KEY FK_301CB412E90161FC');
        $this->addSql('DROP TABLE juguetes');
        $this->addSql('DROP TABLE publico_objetivo');
    }
}

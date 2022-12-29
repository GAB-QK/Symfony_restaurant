<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229231940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE template ADD utilisateurs_id INT DEFAULT NULL, ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F831E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F83CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_97601F831E969C5 ON template (utilisateurs_id)');
        $this->addSql('CREATE INDEX IDX_97601F83CCD7E912 ON template (menu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE template DROP FOREIGN KEY FK_97601F831E969C5');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('ALTER TABLE template DROP FOREIGN KEY FK_97601F83CCD7E912');
        $this->addSql('DROP INDEX IDX_97601F831E969C5 ON template');
        $this->addSql('DROP INDEX IDX_97601F83CCD7E912 ON template');
        $this->addSql('ALTER TABLE template DROP utilisateurs_id, DROP menu_id');
    }
}

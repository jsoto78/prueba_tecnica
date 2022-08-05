<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803193436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL');
        $pass = '$2y$10$CVhQh5ooZwypa26Zii4rveRx2wHPSuJuk14B7Zlrfs.0QcM8zA232';
        $q = "insert into `user` (email,name,roles,password) values ('admin@test.com','Default Admin','[\"ROLE_ADMIN\"]','$pass')";
        $this->addSql($q);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP name');
    }
}

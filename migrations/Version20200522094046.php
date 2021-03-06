<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522094046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_user (uuid UUID NOT NULL, email VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, roles JSON NOT NULL, hashed_password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
        $this->addSql('COMMENT ON COLUMN app_user.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN app_user.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE post (uuid UUID NOT NULL, user_uuid UUID NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DABFE1C6F ON post (user_uuid)');
        $this->addSql('COMMENT ON COLUMN post.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN post.user_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN post.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DABFE1C6F FOREIGN KEY (user_uuid) REFERENCES app_user (uuid) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DABFE1C6F');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE post');
    }
}

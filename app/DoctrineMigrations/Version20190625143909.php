<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190625143909 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image CHANGE type_image type_image INT DEFAULT NULL, CHANGE product product INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation CHANGE type_image type_image INT DEFAULT NULL, CHANGE product product INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE category category INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image CHANGE product product INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation CHANGE product product INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE category category INT DEFAULT NULL');
    }
}

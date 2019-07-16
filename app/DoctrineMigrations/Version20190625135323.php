<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190625135323 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE super_image (id INT AUTO_INCREMENT NOT NULL, pictureUrl VARCHAR(255) NOT NULL, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL, CHANGE size size INT NOT NULL, CHANGE picture_url pictureUrl VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image_moderation ADD product_id INT DEFAULT NULL, ADD typeimage_id INT DEFAULT NULL, CHANGE size size INT NOT NULL, CHANGE picture_url pictureUrl VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D924584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D9261CCABE5 FOREIGN KEY (typeimage_id) REFERENCES type_image (id)');
        $this->addSql('CREATE INDEX IDX_AC347D924584665A ON image_moderation (product_id)');
        $this->addSql('CREATE INDEX IDX_AC347D9261CCABE5 ON image_moderation (typeimage_id)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE super_image');
        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL, CHANGE size size DOUBLE PRECISION NOT NULL, CHANGE pictureurl picture_url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D924584665A');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D9261CCABE5');
        $this->addSql('DROP INDEX IDX_AC347D924584665A ON image_moderation');
        $this->addSql('DROP INDEX IDX_AC347D9261CCABE5 ON image_moderation');
        $this->addSql('ALTER TABLE image_moderation DROP product_id, DROP typeimage_id, CHANGE size size DOUBLE PRECISION NOT NULL, CHANGE pictureurl picture_url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190625140413 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D9261CCABE5');
        $this->addSql('DROP INDEX IDX_AC347D9261CCABE5 ON image_moderation');
        $this->addSql('ALTER TABLE image_moderation ADD type_image INT DEFAULT NULL, DROP typeimage_id, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D92CB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
        $this->addSql('CREATE INDEX IDX_AC347D92CB3183A8 ON image_moderation (type_image)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D92CB3183A8');
        $this->addSql('DROP INDEX IDX_AC347D92CB3183A8 ON image_moderation');
        $this->addSql('ALTER TABLE image_moderation ADD typeimage_id INT DEFAULT NULL, DROP type_image, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D9261CCABE5 FOREIGN KEY (typeimage_id) REFERENCES type_image (id)');
        $this->addSql('CREATE INDEX IDX_AC347D9261CCABE5 ON image_moderation (typeimage_id)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}

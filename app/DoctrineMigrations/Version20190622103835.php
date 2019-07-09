<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190622103835 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image ADD product_img_moderation INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7D6A6315 FOREIGN KEY (product_img_moderation) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F7D6A6315 ON image (product_img_moderation)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7D6A6315');
        $this->addSql('DROP INDEX IDX_C53D045F7D6A6315 ON image');
        $this->addSql('ALTER TABLE image DROP product_img_moderation, CHANGE product_id product_id INT DEFAULT NULL, CHANGE type_image type_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}

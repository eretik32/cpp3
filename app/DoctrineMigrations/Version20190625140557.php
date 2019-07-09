<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190625140557 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, type_image INT DEFAULT NULL, pictureUrl VARCHAR(255) NOT NULL, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, INDEX IDX_C53D045F4584665A (product_id), INDEX IDX_C53D045FCB3183A8 (type_image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_moderation (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, type_image INT DEFAULT NULL, pictureUrl VARCHAR(255) NOT NULL, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, INDEX IDX_AC347D924584665A (product_id), INDEX IDX_AC347D92CB3183A8 (type_image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D924584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D92CB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_moderation');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}

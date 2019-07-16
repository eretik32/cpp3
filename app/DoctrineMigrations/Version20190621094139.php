<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190621094139 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC54C8C93');
        $this->addSql('DROP INDEX IDX_C53D045FC54C8C93 ON image');
        $this->addSql('ALTER TABLE image ADD type_image INT DEFAULT NULL, DROP type_id, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FCB3183A8 ON image (type_image)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FCB3183A8');
        $this->addSql('DROP INDEX IDX_C53D045FCB3183A8 ON image');
        $this->addSql('ALTER TABLE image ADD type_id INT DEFAULT NULL, DROP type_image, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC54C8C93 FOREIGN KEY (type_id) REFERENCES type_image (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FC54C8C93 ON image (type_id)');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
    }
}

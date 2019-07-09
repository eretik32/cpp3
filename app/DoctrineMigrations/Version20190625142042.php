<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190625142042 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE category_title title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE super_image CHANGE pictureurl picture_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('DROP INDEX IDX_C53D045F4584665A ON image');
        $this->addSql('ALTER TABLE image ADD product INT DEFAULT NULL, DROP product_id, CHANGE type_image type_image INT DEFAULT NULL, CHANGE pictureurl picture_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FD34A04AD ON image (product)');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D924584665A');
        $this->addSql('DROP INDEX IDX_AC347D924584665A ON image_moderation');
        $this->addSql('ALTER TABLE image_moderation ADD product INT DEFAULT NULL, DROP product_id, CHANGE type_image type_image INT DEFAULT NULL, CHANGE pictureurl picture_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D92D34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_AC347D92D34A04AD ON image_moderation (product)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product ADD category INT DEFAULT NULL, DROP category_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD64C19C1 FOREIGN KEY (category) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD64C19C1 ON product (category)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE title category_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD34A04AD');
        $this->addSql('DROP INDEX IDX_C53D045FD34A04AD ON image');
        $this->addSql('ALTER TABLE image ADD product_id INT DEFAULT NULL, DROP product, CHANGE type_image type_image INT DEFAULT NULL, CHANGE picture_url pictureUrl VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F4584665A ON image (product_id)');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D92D34A04AD');
        $this->addSql('DROP INDEX IDX_AC347D92D34A04AD ON image_moderation');
        $this->addSql('ALTER TABLE image_moderation ADD product_id INT DEFAULT NULL, DROP product, CHANGE type_image type_image INT DEFAULT NULL, CHANGE picture_url pictureUrl VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D924584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_AC347D924584665A ON image_moderation (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD64C19C1');
        $this->addSql('DROP INDEX IDX_D34A04AD64C19C1 ON product');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL, DROP category');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('ALTER TABLE super_image CHANGE picture_url pictureUrl VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}

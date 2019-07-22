<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190716050204 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product INT DEFAULT NULL, type_image INT DEFAULT NULL, picture_url VARCHAR(255) NOT NULL, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, INDEX IDX_C53D045FD34A04AD (product), INDEX IDX_C53D045FCB3183A8 (type_image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD64C19C1 (category), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_image (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_moderation (id INT AUTO_INCREMENT NOT NULL, product INT DEFAULT NULL, type_image INT DEFAULT NULL, picture_url VARCHAR(255) NOT NULL, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, INDEX IDX_AC347D92D34A04AD (product), INDEX IDX_AC347D92CB3183A8 (type_image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD64C19C1 FOREIGN KEY (category) REFERENCES category (id)');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D92D34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('ALTER TABLE image_moderation ADD CONSTRAINT FK_AC347D92CB3183A8 FOREIGN KEY (type_image) REFERENCES type_image (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD34A04AD');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D92D34A04AD');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD64C19C1');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FCB3183A8');
        $this->addSql('ALTER TABLE image_moderation DROP FOREIGN KEY FK_AC347D92CB3183A8');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE type_image');
        $this->addSql('DROP TABLE image_moderation');
    }
}

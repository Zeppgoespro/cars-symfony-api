<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240915225210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_programs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, interest_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE models (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E4D6300944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D6300944F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE cars ADD brand_id INT DEFAULT NULL, ADD model_id INT DEFAULT NULL, DROP brand, DROP model, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1444F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147975B7E7 FOREIGN KEY (model_id) REFERENCES models (id)');
        $this->addSql('CREATE INDEX IDX_95C71D1444F5D008 ON cars (brand_id)');
        $this->addSql('CREATE INDEX IDX_95C71D147975B7E7 ON cars (model_id)');
        $this->addSql('ALTER TABLE loan_requests ADD credit_program_id INT DEFAULT NULL, DROP program_id, CHANGE car_id car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loan_requests ADD CONSTRAINT FK_2CC32CFAC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE loan_requests ADD CONSTRAINT FK_2CC32CFACDC0BCB4 FOREIGN KEY (credit_program_id) REFERENCES credit_programs (id)');
        $this->addSql('CREATE INDEX IDX_2CC32CFAC3C6F69F ON loan_requests (car_id)');
        $this->addSql('CREATE INDEX IDX_2CC32CFACDC0BCB4 ON loan_requests (credit_program_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1444F5D008');
        $this->addSql('ALTER TABLE loan_requests DROP FOREIGN KEY FK_2CC32CFACDC0BCB4');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D147975B7E7');
        $this->addSql('ALTER TABLE models DROP FOREIGN KEY FK_E4D6300944F5D008');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE credit_programs');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP INDEX IDX_95C71D1444F5D008 ON cars');
        $this->addSql('DROP INDEX IDX_95C71D147975B7E7 ON cars');
        $this->addSql('ALTER TABLE cars ADD brand VARCHAR(255) NOT NULL, ADD model VARCHAR(255) NOT NULL, DROP brand_id, DROP model_id, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE loan_requests DROP FOREIGN KEY FK_2CC32CFAC3C6F69F');
        $this->addSql('DROP INDEX IDX_2CC32CFAC3C6F69F ON loan_requests');
        $this->addSql('DROP INDEX IDX_2CC32CFACDC0BCB4 ON loan_requests');
        $this->addSql('ALTER TABLE loan_requests ADD program_id INT NOT NULL, DROP credit_program_id, CHANGE car_id car_id INT NOT NULL');
    }
}

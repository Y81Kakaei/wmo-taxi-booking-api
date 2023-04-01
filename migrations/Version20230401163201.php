<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230401163201 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE annual_subsidy_budget (id INT AUTO_INCREMENT NOT NULL, passenger_id INT NOT NULL, budget_in_km DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_F3EA2CAD4502E565 (passenger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey (id INT AUTO_INCREMENT NOT NULL, passenger_id INT NOT NULL, taxi_company_id INT NOT NULL, pick_up_address VARCHAR(255) NOT NULL, drop_off_address VARCHAR(255) NOT NULL, distance_in_km DOUBLE PRECISION NOT NULL, pick_up_date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', arrival_date_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_C816C6A24502E565 (passenger_id), INDEX IDX_C816C6A2807A7045 (taxi_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, is_subsidized TINYINT(1) NOT NULL, left_budget_in_km DOUBLE PRECISION NOT NULL, registration_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BEFE8DDBD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxi_company (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8648F0D4BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annual_subsidy_budget ADD CONSTRAINT FK_F3EA2CAD4502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A24502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2807A7045 FOREIGN KEY (taxi_company_id) REFERENCES taxi_company (id)');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DDBD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE taxi_company ADD CONSTRAINT FK_8648F0D4BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE annual_subsidy_budget DROP FOREIGN KEY FK_F3EA2CAD4502E565');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A24502E565');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2807A7045');
        $this->addSql('ALTER TABLE passenger DROP FOREIGN KEY FK_3BEFE8DDBD0F409C');
        $this->addSql('ALTER TABLE taxi_company DROP FOREIGN KEY FK_8648F0D4BD0F409C');
        $this->addSql('DROP TABLE annual_subsidy_budget');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE journey');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE taxi_company');
    }
}

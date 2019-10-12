<?php

    class PDFDoc extends FPDF
    {
        // En-tete
        public function Header()
        {
            // set margin
            $this->SetMargins(20, 0, 20);

            // Logo
            $this->add_logo();

            // add current date
            $this->setX(-100);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Helvetica', 'i', 11);
            $this->Cell(0, 10, date('l, j F Y'), 0, 1, 'C');
            
            // Title
            $this->add_title('Individual account details');

            // Saut de ligne
            $this->Ln(7);
        }

        public function add_section($url, $title, $data_list)
        {
            $this->line(20, $this->GetY(), 190, $this->GetY());
            $this->SetXY(22, $this->GetY() + 2);
            $this->add_img($url);

            $this->SetXY(20 + 15, $this->GetY() - 10);
            $this->SetFont('Helvetica', 'B', 12);
            $this->cell(40, 10, $title, 0, 1, 'L', false);

            $this->SetFont('Helvetica', null, 9);
            foreach ($data_list as $key=>$value) {
                $this->cell(50, 5, $key, 0, 0, 'L', false);
                $this->cell(80, 6, $value, 0, 1, 'L', false);
            }
            $this->ln(7);
            $this->line(20, $this->GetY(), 190, $this->GetY());
        }

        public function add_logo()
        {
            $this->setXY(20, 10);
            $this->SetFont('Arial', 'BIU', 12);
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0, 0, 0);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(235, 31, 27);
            $this->Cell(40, 10, 'CitiFinance', 0, 0, 'C', true);
        }
        public function add_title($title)
        {
            $this->ln(7);
            $this->SetFont('Helvetica', 'B', 15);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(70, 10, $title, 0, 1, 'L', false);
        }
        public function add_img($url)
        {
            $this->image('http://localhost' . url_for($url), null, null, 10, 10);
        }

        // Pied de page
        public function Footer()
        {
            // Positionnement � 1,5 cm du bas
            $this->SetY(-15);
            $this->SetFont('Helvetica', 'i', 10);
            $this->Cell(0, 10, 'Your CitiFinance', 0, 0, 'C');
        }
    }

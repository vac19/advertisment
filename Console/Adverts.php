<?php
/*
 * Console Class for add Advertisment into DB table.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Salecto\Advertisment\Model\GridModelFactory;
/**
 * Class SomeCommand
 */
class Adverts extends Command
{
    /**
     * command input parameter 'title'
     */
    const TITLE = 'title';

    /**
     * command input parameter 'status'
     */
    const STATUS = 'status';

    /**
     * @var \Salecto\Advertisment\Model\GridModelFactory
     */
    protected $_model;

    /**
     * Constructor
     *
     * @param \Salecto\Advertisment\Model\GridModelFactory
     */
    public function __construct(
        GridModelFactory $model
    ) {
        
        $this->_model = $model;
        parent::__construct();
    }


    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('add:advert');
        $this->setDescription('This is my first console command.');
        $this->addOption(
                self::TITLE,
                null,
                InputOption::VALUE_REQUIRED,
                'TITLE'
            );
        $this->addOption(
                self::STATUS,
                null,
                InputOption::VALUE_REQUIRED,
                'STATUS'
            );

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $title = $input->getOption(self::TITLE);
        $status = $input->getOption(self::STATUS);
        $rowData = $this->_model->create();
        if (($status) && ($title) && (($status == 0) || ($status == 1))) {
            try{
                $rowData->setTitle($title);
                $rowData->setAdStatus($status);
                $result = $rowData->save();
                $output->writeln('<info>Success: New Advertisment added with Id Number- `' . $result->getAdId() . '`</info>');

            }catch (\Exception $e){
                $output->writeln('<info>Can not save new advertisment - `' . $e . '`</info>');            
            }
        } else {
            $output->writeln('<info> not Allowed</info>');
        }
    }
}

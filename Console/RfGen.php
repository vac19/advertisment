<?php
/*
 * Console Class remove generated folder.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Filesystem;

class RfGen extends Command
{

  /**
   * @inheritDoc
   */
  protected function configure()
  {
     $this->setName('rf:gen');
     $this->setDescription('Remove Generated Folder');
     
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
    $fs = new Filesystem();
    try {
      if($fs->exists('generated')){
          $fs->remove(array('generated'));
          $output->writeln('<info>Generated Folder Removed!</info>');
      }
      else {
        $output->writeln('<error>Generated Folder\'s aleady deleted</error>');
      }
    } catch (IOExceptionInterface $e) {
        echo "An error occurred while deleting your directory at ".$e->getPath();
      }
  }
}

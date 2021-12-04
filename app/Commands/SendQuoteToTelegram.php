<?php

namespace App\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendQuoteToTelegram extends Command
{
    protected static $defaultName = 'quote:send';
    protected static $defaultDescription = 'Send quote to telegram group';

    const ENDPOINT = "qod";
    const API_URL = "https://quotes.rest/";
    const TELEGRAM_URI = 'https://api.telegram.org/bot';

    private string $bot_id;
    private string $chat_id;
    private string $quote;
    private string $category;
    private mixed $client;

    protected function configure()
    {
        $this->addArgument('category', InputArgument::REQUIRED, 'Quote category');
        $this->bot_id = $_ENV['TELEGRAM_BOT_KEY'];
        $this->chat_id = $_ENV['TELEGRAM_GROUP'];
        $this->quote = 'hello';
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->category = $input->getArgument('category');

        try {
            $this->fetchQuote();
            $this->sendTelegramMessage();
        } catch (GuzzleException $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * @throws GuzzleException
     */
    public function fetchQuote()
    {
        $this->client = new Client();
        $response = $this->client->request(
            'GET',
            self::API_URL . self::ENDPOINT . "?category=$this->category&language=en",
            ['headers' => [
                'accept' => 'application/json'
            ]]
        );

        $this->quote = $response->getBody()->getContents();
        $this->quote = $this->quote->quote;
    }

    /**
     * @throws GuzzleException
     */
    public function sendTelegramMessage()
    {
        $this->client = new Client();

        $this->client->request(
            'GET',
            self::TELEGRAM_URI . $this->bot_id . DIRECTORY_SEPARATOR . 'sendMessage?' .
            'chat_id=' . $this->chat_id . '&text=' . $this->quote,
        );
    }
}
<?php

class ErrorHandler {
    // will be used as follows:
    // $errorHandler = new ErrorHandler();
    // set_error_handler([$errorHandler, 'handleError']);
    // set_exception_handler([$errorHandler, 'handleException']);
    public function handleError($errno, $errstr, $errfile, $errline) {
        $message = "$errstr in $errfile on line $errline";
        switch ($errno) {
            case E_NOTICE:
            case E_USER_NOTICE:
                $this->logError($message, 'notice');
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $this->logError($message, 'warning');
                break;
            case E_ERROR:
            case E_USER_ERROR:
                $this->logError($message, 'error');
                break;
            default:
                $this->logError($message, 'unknown');
                break;
        }
    }

    public function handleException($exception) {
        $this->logError($exception->getMessage(), 'exception');
    }

    protected function logError($message, $type) {
        // log the error message
        error_log($message);        
        // send notifications
        $this->sendNotifications($message, $type);
    }

    protected function sendNotifications($message, $type) {
        // send email
        // send sms
        // send slack
        // send push notification
    }
}

<?php
namespace MailPoetVendor;
if (!defined('ABSPATH')) exit;
class Swift_CharacterStream_NgCharacterStream implements Swift_CharacterStream
{
 private $charReader;
 private $charReaderFactory;
 private $charset;
 private $datas = '';
 private $datasSize = 0;
 private $map;
 private $mapType = 0;
 private $charCount = 0;
 private $currentPos = 0;
 public function __construct(Swift_CharacterReaderFactory $factory, $charset)
 {
 $this->setCharacterReaderFactory($factory);
 $this->setCharacterSet($charset);
 }
 public function setCharacterSet($charset)
 {
 $this->charset = $charset;
 $this->charReader = null;
 $this->mapType = 0;
 }
 public function setCharacterReaderFactory(Swift_CharacterReaderFactory $factory)
 {
 $this->charReaderFactory = $factory;
 }
 public function flushContents()
 {
 $this->datas = null;
 $this->map = null;
 $this->charCount = 0;
 $this->currentPos = 0;
 $this->datasSize = 0;
 }
 public function importByteStream(Swift_OutputByteStream $os)
 {
 $this->flushContents();
 $blocks = 512;
 $os->setReadPointer(0);
 while (\false !== ($read = $os->read($blocks))) {
 $this->write($read);
 }
 }
 public function importString($string)
 {
 $this->flushContents();
 $this->write($string);
 }
 public function read($length)
 {
 if ($this->currentPos >= $this->charCount) {
 return \false;
 }
 $ret = \false;
 $length = $this->currentPos + $length > $this->charCount ? $this->charCount - $this->currentPos : $length;
 switch ($this->mapType) {
 case Swift_CharacterReader::MAP_TYPE_FIXED_LEN:
 $len = $length * $this->map;
 $ret = \substr($this->datas, $this->currentPos * $this->map, $len);
 $this->currentPos += $length;
 break;
 case Swift_CharacterReader::MAP_TYPE_INVALID:
 $ret = '';
 for (; $this->currentPos < $length; ++$this->currentPos) {
 if (isset($this->map[$this->currentPos])) {
 $ret .= '?';
 } else {
 $ret .= $this->datas[$this->currentPos];
 }
 }
 break;
 case Swift_CharacterReader::MAP_TYPE_POSITIONS:
 $end = $this->currentPos + $length;
 $end = $end > $this->charCount ? $this->charCount : $end;
 $ret = '';
 $start = 0;
 if ($this->currentPos > 0) {
 $start = $this->map['p'][$this->currentPos - 1];
 }
 $to = $start;
 for (; $this->currentPos < $end; ++$this->currentPos) {
 if (isset($this->map['i'][$this->currentPos])) {
 $ret .= \substr($this->datas, $start, $to - $start) . '?';
 $start = $this->map['p'][$this->currentPos];
 } else {
 $to = $this->map['p'][$this->currentPos];
 }
 }
 $ret .= \substr($this->datas, $start, $to - $start);
 break;
 }
 return $ret;
 }
 public function readBytes($length)
 {
 $read = $this->read($length);
 if (\false !== $read) {
 $ret = \array_map('ord', \str_split($read, 1));
 return $ret;
 }
 return \false;
 }
 public function setPointer($charOffset)
 {
 if ($this->charCount < $charOffset) {
 $charOffset = $this->charCount;
 }
 $this->currentPos = $charOffset;
 }
 public function write($chars)
 {
 if (!isset($this->charReader)) {
 $this->charReader = $this->charReaderFactory->getReaderFor($this->charset);
 $this->map = [];
 $this->mapType = $this->charReader->getMapType();
 }
 $ignored = '';
 $this->datas .= $chars;
 $this->charCount += $this->charReader->getCharPositions(\substr($this->datas, $this->datasSize), $this->datasSize, $this->map, $ignored);
 if (\false !== $ignored) {
 $this->datasSize = \strlen($this->datas) - \strlen($ignored);
 } else {
 $this->datasSize = \strlen($this->datas);
 }
 }
}

<?php 

namespace Services\Notices;

class NoticesService implements NoticesInterface {

	private $title;
	private $body;
	private $author;
	private $subject;
	private $targets = array();
	private $timestamp;
	private $type;

	private $notices;

	private $notices_target;

	private $date;

	public function __construct(\Notices $notices, \NoticesTarget $notices_target)
	{
		$this->notices = $notices;
		$this->notices_target = $notices_target;
		$this->date = new \DateTime();
		$this->timestamp = $this->date->format('Y-m-d H:i:s');
	}

	public function setNoticeData($title = null, $body = null, $author = null, $subject = null, $type = null)
	{
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->subject = $subject;
		$this->type = $type;
	}
	public function setNoticeTarget($notice_target = array())
	{
		$this->targets = $notice_target;
	}
	public function insertNotice()
	{
		$this->notices->title = $this->title;
		$this->notices->body = $this->body;
		$this->notices->author = $this->author;
		$this->notices->type = $this->type;
		$this->notices->subject = $this->subject;
		$this->notices->created_at = $this->timestamp;
		$this->notices->save();
		$insertedid = $this->notices->id;
		foreach ($this->targets as $target)
		{
			$this->notices_target->notice_id = $insertedid;
			$this->notices_target->notice_target = $target;
			$this->notices_target->created_at = $this->timestamp;
			$this->notices_target->save();
		}
	}
}


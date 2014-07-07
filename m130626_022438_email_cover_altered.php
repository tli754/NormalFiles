<?php

class m130626_022438_email_cover_altered extends DbMigration
{
    protected function getUpSql()
    {
        $sql = array();

        $sql[] = <<<'EOD'
INSERT INTO email_templates (LanguageId, Type, Code, Recipient, Sender,Name, Subject, Body) VALUES

((SELECT LanguageId FROM languages WHERE Code = 'en'), 'Internal', 'COVER_ALTERED', 'Sales','System',
'Cover altered',
'Cover altered: {{booking.policy.Name}} | {{booking.Reference}}',

'
<p>Reference: {{booking.Reference}}</p>

<p>Policy: {{booking.policy.Name}}</p>

<p>Cover was modified by agent. If dates or cover amount were changed cover requires to be manually updated in QBE.</p>

<p>Before:</p>

<p><pre>{{before}}</pre></p>

<p>After:</p>

<p><pre>{{after}}</pre></p>

');


EOD;

        return $sql;
    }

    protected function getDownSql()
    {
        $sql = array();

        $sql[] = <<<'EOD'
DELETE FROM email_templates WHERE Code = 'COVER_ALTERED';
EOD;

        return $sql;
    }

}

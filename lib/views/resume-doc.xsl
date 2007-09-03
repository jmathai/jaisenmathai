<?xml version='1.0' encoding='UTF-8'?>
<xsl:stylesheet version = '1.0'
   xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>
<xsl:output encoding="UTF-8" method="html" indent="yes"
   omit-xml-declaration="yes" />
   
<xsl:template match="/">

<html lang="en">

<head>
  
</head>

<body>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <strong><xsl:value-of select="/resume/contact/name" /></strong>
        <xsl:value-of select="/resume/contact/phone/mobile" />
        <br/>
        <xsl:value-of select="/resume/contact/email" />
      </td>
    </tr>
  </table>
  
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><strong>Objective</strong></td>
    </tr>
    <tr>
      <td><xsl:value-of select="/resume/objective" /></td>
    </tr>
  </table>
  
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><strong>Experience</strong></td>
    </tr>
      <xsl:for-each select="/resume/job">
        <tr>
          <td>
            <strong><xsl:value-of select="company" />: </strong>
            <xsl:value-of select="title" />
            <xsl:if test="title/@department != ''">
              (<xsl:value-of select="title/@department" />)
            </xsl:if>
          </td>
          <td>
            <strong><xsl:value-of select="date-start" /> - <xsl:value-of select="date-stop" /></strong>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <ul>
              <xsl:for-each select="accomplishments/task">
                <li><xsl:value-of select="." /></li>
              </xsl:for-each>
            </ul>
          </td>
        </tr>
      </xsl:for-each>
  </table>
  
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3"><strong>Skills</strong></td>
    </tr>
    <tr>
      <xsl:for-each select="resume/skills/skill">
        <tr>
          <td valign="top" width="110"><strong><xsl:value-of select="@name" />:</strong></td>
          <td width="4"></td>
          <td><xsl:value-of select="." /></td>
        </tr>
        <tr height="10">
          <td colspan="3"> </td>
        </tr>
      </xsl:for-each>
    </tr>
  </table>
      
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><strong>Conferences and Publications</strong></td>
    </tr>
    <tr>
      <td>
          <ul>
            <xsl:for-each select="/resume/publications/publication">
              <li>
                <strong><xsl:value-of select="name" /> (<xsl:value-of select="date" />)</strong>
                <br/>
                <xsl:value-of select="description" />
              </li>
            </xsl:for-each>
          </ul>
        </td>
    </tr>
  </table>
</body>

</html>
      
    <br clear="all" />
  </xsl:template>
</xsl:stylesheet>

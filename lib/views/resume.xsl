<?xml version='1.0' encoding='UTF-8'?>
<xsl:stylesheet version = '1.0'
   xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>
<xsl:output encoding="UTF-8" method="html" indent="yes"
   omit-xml-declaration="yes" />

  <xsl:template match="/">
    <div id="resume">
      <div id="resume-header">
        <h1><xsl:value-of select="/resume/contact/name" /></h1>
        <!--
        <ul>
          <li><xsl:value-of select="/resume/contact/phone/mobile" /></li>
          <li><xsl:value-of select="/resume/contact/email" /></li>
        </ul>
        -->
      </div>
      
      <div id="resume-objective">
        <h2>Objective</h2>
        <xsl:value-of select="/resume/objective" />
      </div>
      
      <div id="resume-experience">
        <h2>Experience</h2>
        <xsl:for-each select="/resume/job">
          <ul>
            <li class="company">
              <strong><xsl:value-of select="company" />: </strong>
              <xsl:value-of select="title" />
              <xsl:if test="title/@department != ''">
                (<xsl:value-of select="title/@department" />)
              </xsl:if>
            </li>
            <li class="dates">
              <strong><xsl:value-of select="date-start" /> - <xsl:value-of select="date-stop" /></strong>
            </li>
          </ul>
          <div>
            <ul>
              <xsl:for-each select="accomplishments/task">
                <li><xsl:value-of select="." /></li>
              </xsl:for-each>
            </ul>
          </div>
        </xsl:for-each>
      </div>
      
      <div id="resume-skills">
        <h2>Skills</h2>
        <div>
          <table border="0" cellpadding="0" cellspacing="0">
            <xsl:for-each select="resume/skills/skill">
              <tr>
                <td valign="top"><strong><xsl:value-of select="@name" />:</strong></td>
                <td width="4"></td>
                <td><xsl:value-of select="." /></td>
              </tr>
              <tr height="10">
                <td colspan="3"> </td>
              </tr>
            </xsl:for-each>
          </table>
        </div>
      </div>
      
      <div id="resume-publications">
        <h2>Conferences and Publications</h2>
        <div>
          <ul>
            <xsl:for-each select="/resume/publications/publication">
              <li>
                <ul>
                  <li><strong><xsl:value-of select="name" /> (<xsl:value-of select="date" />)</strong></li>
                  <li><xsl:value-of select="description" /></li>
                </ul>          
              </li>
            </xsl:for-each>
          </ul>
        </div>
      </div>
    </div>
    <br clear="all" />
  </xsl:template>
</xsl:stylesheet>

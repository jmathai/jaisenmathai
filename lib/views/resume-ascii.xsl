<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output encoding="UTF-8" method="html" indent="no" omit-xml-declaration="yes"/>

<xsl:template match="/">
    <xsl:value-of select="/resume/contact/name"/><br/>
    <!--
    <xsl:value-of select="/resume/contact/phone/mobile"/><br/>
    <xsl:value-of select="/resume/contact/email"/><br/>
    -->
    <br/>

    Objective: <xsl:value-of select="/resume/objective"/><br/>

    <xsl:for-each select="/resume/job">
        <br/>
        ======================================================
        <br/>
        Job: <xsl:value-of select="company"/> - 
        <xsl:value-of select="title"/><br/>
        <xsl:if test="title/@department != ''">
            (<xsl:value-of select="title/@department"/>)
        </xsl:if>
        <xsl:value-of select="date-start"/> -
        <xsl:value-of select="date-stop"/>
        <br/><br/>

        <xsl:for-each select="accomplishments/task">
            * <xsl:value-of select="."/><br/><br/>
        </xsl:for-each>
        <br/>
    </xsl:for-each>
    
    <br/>
    ======================================================
    <br/>
    <xsl:for-each select="/resume/skills/skill">
        Skill: <xsl:value-of select="@name"/>
        <br/>
        * <xsl:value-of select="."/><br/>
        <br/><br/>
    </xsl:for-each>

    <br/>
    ======================================================
    <br/>
    <xsl:for-each select="/resume/publications/publication">
        <xsl:value-of select="type"/>: <xsl:value-of select="name"/> (<xsl:value-of select="date"/>)
        <br/>
        <xsl:value-of select="description"/>
        <br/><br/>
    </xsl:for-each>
</xsl:template>
</xsl:stylesheet>

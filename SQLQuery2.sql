USE [SWN_Demo]
GO
/****** Object:  UserDefinedFunction [dbo].[getSynsetIDs]    Script Date: 9/26/2023 12:54:29 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- @tipPretrage: 0 exact match, 1 počinje sa, 2 sadrži
-- @Lit , @Def  , @Dom , @Usage: gde se sve pretražuje reč ili deo reči, 0 ili 1  
-- select * from getSynsetIDs(N'ku','sr','sr',1, 1,0,0,0)
-- =============================================
ALTER FUNCTION [dbo].[getSynsetIDs](@kw nvarchar(1000),  @lngIn nvarchar(10), @lngOut nvarchar(10), @tipPretrage integer, @Lit integer, @Def  integer, @Dom integer, @Usage  integer)
RETURNS @retTab TABLE (IdSrpwn int, SynsetID nvarchar(50), Domain nvarchar(30))
AS
BEGIN
    declare @kw1 nvarchar(1000) 
	SELECT @kw1 = (CASE  @tipPretrage WHEN 2 then '%' else '' end) + @kw +(CASE  @tipPretrage WHEN 0 then '' else '%' end)
	-- Fill the table variable with the rows for your result set
	INSERT INTO @retTab 
	SELECT    ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
	JOIN [Synonyms] sy ON ss.IdSrpwn=sy.IdSrpwn
	WHERE (sy.Literal like @kw1  and @Lit=1) or (Domain like @kw1 and  @Dom=1)
	UNION
	SELECT    ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
	JOIN [Definitions] d ON ss.IdSrpwn=d.IdSrpwn
	WHERE d.Def like @kw1  and @Def=1
    UNION
	SELECT    ss.IdSrpwn, ss.ID, ss.Domain FROM SRPWN ss
	JOIN [Usages] u ON ss.IdSrpwn=u.IdSrpwn
	WHERE u.Usage like @kw1  and @Usage=1

	RETURN 
END

# eViasWeb utility makefile

LOCALES_ROOT_DIR=application/locales
LOCALES= fr en de

locales :
	@echo " "
	@echo " "
	@echo " -- Will now compile .po files to .mo"
	$(foreach locale, ${LOCALES}, `msgfmt ${LOCALES_ROOT_DIR}/${locale}/${locale}.po -o ${LOCALES_ROOT_DIR}/${locale}/LC_MESSAGES/messages.mo`)
	@echo " "
	@echo " "
	@echo " -- locales have been built correctly"

